<?php

namespace App\Http\Controllers;

use App\Models\Defect;
use App\Models\DefectDetail;
use Illuminate\Http\Request;
use DB;
use App\Models\Pemasangan;
use App\Http\Requests\StoreDefectRequest;
use App\Http\Requests\UpdateDefectRequest;
use Scaffolding\Traits\ScaffoldingTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use PDF;

class DefectController extends Controller
{
    use ScaffoldingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // extract($this->_vars());
        $prefix = 'defect';
        $title = 'Defect';
        $model = new Defect();
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
            'withQuery' => Defect::select([
                'defect.*',
                'aa.no_mesin',
                'aa.no_sasis',
                'aa.type',
                'aa.varian',
                'aa.warna'
            ])
                ->LeftJoin('pemasangans as aa', 'aa.id','=','defect.pemasangan_id')
            ])
            ->datatableColumnUnset([], true)
            ->datatableColumnSet([
                'id' => [
                    'title' => 'ID',
                    'searchPlaceHolder' => '',
                ],
                'defect_number' => [
                    'title' => 'No. Defect',
                    'searchPlaceHolder' => '',
                ],
                'created_at' => [
                    'title' => 'Tanggal',
                    'searchPlaceHolder' => '',
                    'searchable' => false,
                    'formatter' => function($model){
                        return date('d-m-Y', strtotime($model->created_at));
                    }
                ],
                'jam_temuan' => [
                    'title' => 'Jam Temuan',
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
                'type' => [
                    'title' => 'Type',
                    'searchPlaceHolder' => '',
                    'filter' => function (Builder $builder, $keyword) {
                        $builder->where('aa.type', $keyword);
                    }
                ],
                'varian' => [
                    'title' => 'Varian',
                    'searchPlaceHolder' => '',
                    'filter' => function (Builder $builder, $keyword) {
                        $builder->where('aa.varian', $keyword);
                    }
                ],
                'warna' => [
                    'title' => 'Warna',
                    'searchPlaceHolder' => '',
                    'filter' => function (Builder $builder, $keyword) {
                        $builder->where('aa.warna', $keyword);
                    }
                ],
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $model = null;
        if($request->method() == 'PUT') return $this->save($request);
        return view('pages.defect.create',get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
        $model = Defect::with('details')->findOrFail($id);
        $actionOptions = [
            '1' => 'Ganti Part',
            '2' => 'Repair Part',
            '3' => 'Rubbing',
            '4' => 'Beban Bersama',
            '5' => 'Lainnya'
        ];
        if($request->method() == 'PATCH') return $this->save($request, $id);
        return view('pages.defect.edit', get_defined_vars());
    }

    public function view($id)
    {
        $actionOptions = [
            '1' => 'Ganti Part',
            '2' => 'Repair Part',
            '3' => 'Rubbing',
            '4' => 'Beban Bersama',
            '5' => 'Lainnya'
        ];
        $model =  Defect::with('details', 'pemasangan')->findOrFail($id);
        // dd($model);
        return view('pages.defect.view', get_defined_vars());
    }

    public function save(Request $request, $id = null)
    {
        try {
            DB::beginTransaction();
            $model = $id ? Defect::findOrFail($id) : new Defect();
            $model->fill($request->all());
    
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($id && $model->image) {
                    Storage::delete($model->image);
                }
    
                // Store the new image
                $imagePath = $request->file('image')->store('defect_images', 'public');
                $model->image = $imagePath;
            }
    
            if (!$id) {
                $date = now()->format('dmy');
                $lastDefect = Defect::whereDate('created_at', now()->toDateString())->latest()->first();
                $nextId = $lastDefect ? ((int) substr($lastDefect->defect_number, -3)) + 1 : 1;
                $model->defect_number = 'DEF-' . $date . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
            }

            $model->status_id = 1; 
            $model->save();
            DB::commit();
    
            return $request->ajax() ? response([
                'message' => 'Data disimpan',
                'redirect' => route('defect.index'),
                'data' => $model,
            ]) : redirect(route('defect.index'))->with('success', 'Data Berhasil Di Simpan');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
            return back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
    
    public function fetchData(Request $request)
    {
        $defectId = $request->input('defect_id');
        $data = Pemasangan::findOrFail($defectId);
        return response()->json($data);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $defect = Defect::findOrFail($id);
            $defect->delete();
            DB::commit();

            return redirect()->route('defect.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function cetak()
    {
        return view('pages.defect.cetak', get_defined_vars()); 
    }
    public function getcetak(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $query = Defect::query();
    
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        $defect = $query->get();
        $actionOptions = [
            '1' => 'Ganti Part',
            '2' => 'Repair Part',
            '3' => 'Rubbing',
            '4' => 'Beban Bersama',
            '5' => 'Lainnya'
        ];
        $pdf = PDF::loadview('pages.laporan.defect', compact('defect','actionOptions'))->setPaper('a4', 'landscape');
        return $pdf->stream("defect" . ".pdf");
    }
}
