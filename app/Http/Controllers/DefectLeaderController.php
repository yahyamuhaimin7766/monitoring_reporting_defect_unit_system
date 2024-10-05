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
use PDF;

class DefectLeaderController extends Controller
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
        $prefix = 'defect.leader';
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
            'actions' => ['view'],
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
                    'formatter' => function ($model) {
                        return $model->created_at->format('d-m-Y');
                    },
                    'filter' => function (Builder $builder, $keyword) {
                        $builder->where('defect.created_at', date('Y-m-d', strtotime($keyword)));
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

}
