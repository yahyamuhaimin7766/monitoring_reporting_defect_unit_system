<?php

namespace App\Http\Controllers;

use App\Models\Defect;
use App\Models\Repair;
use Illuminate\Http\Request;
use DB;
use App\Models\Pemasangan;
use App\Http\Requests\StoreDefectRequest;
use App\Http\Requests\UpdateDefectRequest;
use Scaffolding\Traits\ScaffoldingTrait;
use PDF;

class LaporanController extends Controller
{
    use ScaffoldingTrait;
    public function index()
    {
        return view('pages.leader.index', get_defined_vars());
    }

    public  function cetak(Request $request)
    {
        $dataType = $request->type_laporan;
        switch ($dataType) {
            case '1':
                $query = Defect::query();
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
                break;
            case '2':
                $query = Repair::query();
                $repair = $query->get();
                $pdf = PDF::loadview('pages.laporan.repair', compact('repair'))->setPaper('a4', 'landscape');
                return $pdf->stream("repair" . ".pdf");
            break;
            
            default:
                
            break;
        }
    }
   

}
