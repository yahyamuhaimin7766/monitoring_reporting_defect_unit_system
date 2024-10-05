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

class RepairLeaderController extends Controller
{
    use ScaffoldingTrait;

    public function __construct()
    {
        $prefix = 'repair.leader';
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
            'actions' => ['view'],
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
    public function view($id)
    {
        $model =  Repair::with('defect')->findOrFail($id);
        return view('pages.repair.view', get_defined_vars());
    }
}
