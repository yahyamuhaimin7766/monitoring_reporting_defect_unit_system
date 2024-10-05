<?php

namespace App\Http\Controllers;

use App\Models\Pemasangan;
use App\Http\Requests\StorePemasanganRequest;
use App\Http\Requests\UpdatePemasanganRequest;
use Scaffolding\Traits\ScaffoldingTrait;
use Illuminate\Http\Request;
use DB;
use PDF;

class PemasanganController extends Controller
{
    use ScaffoldingTrait;
    public function _vars()
    {
        
    }
    public function __construct()
    {
        $prefix = 'pemasangan';
        $title = 'Pemasangan';
        $model = new Pemasangan();
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
        ])
            ->datatableColumnUnset([], true)
            ->datatableColumnSet([
                'id' => [
                    'title' => 'ID',
                    'searchPlaceHolder' => '',
                ],
                'tanggal' => [
                    'title' => 'Tanggal',
                    'searchPlaceHolder' => '',
                    'formatter' => function($model)
                    {
                        return date('d-m-Y', strtotime($model->tanggal));
                    }
                ],
                'no_mesin' => [
                    'title' => 'Nomor Mesin',
                    'searchPlaceHolder' => '',
                ],
                'no_sasis' => [
                    'title' => 'Nomor Sasis',
                    'searchPlaceHolder' => '',
                ],
                'type' => [
                    'title' => 'Type',
                    'searchPlaceHolder' => '',
                ],
                'varian' => [
                    'title' => 'Varian',
                    'searchPlaceHolder' => '',
                ],
                'warna' => [
                    'title' => 'Warna',
                    'searchPlaceHolder' => '',
                ]
            ]);
    }
    public function create(StorePemasanganRequest $request)
    {
        $model = '';
        if($request->method() == 'PUT') return $this->save($request);
        return view('pages.pemasangan.create', get_defined_vars());
    }
    public function edit(StorePemasanganRequest $request, $id)
    {
        $model = Pemasangan::findOrFail($id);
        if($request->method() == 'PATCH') return $this->save($request, $id);
        return view('pages.pemasangan.edit', get_defined_vars());
    }

    public function view($id)
    {
        $model = Pemasangan::findOrFail($id);
        return view('pages.pemasangan.view', get_defined_vars());
    }

    public function save(StorePemasanganRequest $request, $id = null)
    {
        try {
            $model = $id ? Pemasangan::findOrFail($id) : new Pemasangan();
            $model->fill($request->all());
            $model->save();
    
            DB::commit();
            return $request->ajax() ? response([
                'message' => 'Data disimpan',
                'redirect' => route('pemasangan.index'),
                'data' => $model,
            ]):redirect(route('pemasangan.index'))->with('success','Data Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex);
        }
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $pemasangan = Pemasangan::findOrFail($id);
            $pemasangan->delete();
            DB::commit();

            return redirect()->route('pemasangan.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function cetak()
    {
        return view('pages.pemasangan.cetak', get_defined_vars()); 
    }
    public function getcetak(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $query = Pemasangan::query();
    
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        $pemasangan = $query->get();
        $pdf = PDF::loadview('pages.laporan.pemasangan', compact('pemasangan'))->setPaper('a4', 'landscape');
        return $pdf->stream("pemasangan" . ".pdf");
    }
}
