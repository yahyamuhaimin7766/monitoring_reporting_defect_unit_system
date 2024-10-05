<?php

namespace App\Http\Controllers;

use App\Models\Defect;
use App\Models\Repair;
use App\Models\DefectDetail;
use Illuminate\Http\Request;
use DB;
use App\Models\Pemasangan;
use App\Http\Requests\StoreDefectRequest;
use App\Http\Requests\UpdateDefectRequest;
use Scaffolding\Traits\ScaffoldingTrait;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class RepairController extends Controller
{
    use ScaffoldingTrait;

    public function __construct()
    {
        $prefix = 'repair';
        $title = 'Repair';
        $model = new Repair();
        $this->setConfig([
            'model' => $model,
            'prefix' => $prefix,
            'title' => $title,
        ]);
        $this->scaffolding()->datatableSet([
            'checkbox' => false,
            'timestamp' => false,
            'dom' => '<"top display-flex">lrt<"bottom"p>',
            'viewToolbar' => view('scaffolding::index-toolbar'),
            'lengthMenu' => [10, 30, 50, 100, 200],
            'order' => [0, 'asc'],
            'actions' => ['edit','view'],
            'withQuery' => Repair::select([
                'repairs.*',
                'aa.no_mesin',
                'aa.no_sasis',
                'aa.type',
                'aa.varian',
                'aa.warna',
                'aa.id as id_pemasangan',
                'bb.id as id_defect',
                'bb.defect_number',
            ])
                ->LeftJoin('defect as bb', 'bb.id','=','repairs.defect_id')
                ->LeftJoin('pemasangans as aa', 'aa.id','=','bb.pemasangan_id')
        ])
            ->datatableColumnUnset([], true)
            ->datatableColumnSet([
                'id' => [
                    'title' => 'ID',
                    'searchPlaceHolder' => '',
                ],
                'created_at' => [
                    'title' => 'Tanggal',
                    'searchPlaceHolder' => '',
                    'formatter' => function ($model) {
                        return $model->created_at->format('d-m-Y');
                    },
                    'filter' => function (Builder $builder, $keyword) {
                        $builder->where('repairs.created_at', date('Y-m-d', strtotime($keyword)));
                    }
                ],
                'refair_number' => [
                    'title' => 'Refair Code',
                    'searchPlaceHolder' => '',
                ],
                'defect_number' => [
                    'title' => 'Defect Code',
                    'searchPlaceHolder' => '',
                ],
                'no_mesin' => [
                    'title' => 'No Mesin',
                    'searchPlaceHolder' => '',
                    'filter' => function (Builder $builder, $keyword) {
                        $builder->where('aa.no_mesin', $keyword);
                    },
                ],
                'no_sasis' => [
                    'title' => 'No Sasis',
                    'searchPlaceHolder' => '',
                    'filter' => function (Builder $builder, $keyword) {
                        $builder->where('aa.no_sasis', $keyword);
                    },
                ],

            ]);
    }

    public function create(Request $request)
    {
        $model = null;
        if($request->method() == 'PUT') return $this->save($request);
        return view('pages.repair.create',get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
        $model = Repair::with('defect')->findOrFail($id);
        if($request->method() == 'PATCH') return $this->save($request, $id);
        return view('pages.repair.edit', get_defined_vars());
    }

    public function view($id)
    {
        $model =  Repair::with('defect')->findOrFail($id);
        return view('pages.repair.view', get_defined_vars());
    }

    public function save(Request $request, $id = null)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $model = $id ? Repair::findOrFail($id) : new Repair();
            $model->fill($request->all());

            if (!$id) {
                $date = now()->format('dmy');
                $lastRefair = Repair::whereDate('created_at', now()->toDateString())->latest()->first();
                $nextId = $lastRefair ? ((int) substr($lastRefair->refair_number, -3)) + 1 : 1;
                $model->refair_number = 'REF-' . $date . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
            }
            $model->status_id = 3;
            $model->save();
            DB::commit();
    
            return $request->ajax() ? response([
                'message' => 'Data disimpan',
                'redirect' => route('repair.index'),
                'data' => $model,
            ]) : redirect(route('repair.index'))->with('success', 'Data Berhasil Di Simpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function fetchData(Request $request)
    {
        $defectId = $request->input('defect_id');
        $data = Defect::findOrFail($defectId);
        return response()->json($data);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $repair = Repair::findOrFail($id);
            $repair->delete();
            DB::commit();
            return redirect()->route('repair.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function cetak()
    {
        return view('pages.repair.cetak', get_defined_vars()); 
    }

    public function getcetak(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $query = Repair::query();
    
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        $repair = $query->get();
        $pdf = PDF::loadview('pages.laporan.repair', compact('repair'))->setPaper('a4', 'landscape');
        return $pdf->stream("repair" . ".pdf");
    }
}
