<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Pemasangan;
use App\Models\Defect;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        [$view, $data] = $this->getDashboardViewByRole($user);
        return view($view, $data);

    }

    private function getDashboardViewByRole($user)
    {
        if ($user->hasRole('leader')) {
            return ['pages.dashboard.leader',[]];
        }
        if ($user->hasRole('qc')) {
            $totalDefects = Defect::count();
            $recentDefects = Defect::orderBy('created_at', 'desc')->take(5)->get();
            return ['pages.dashboard.qc', [
                'totalDefects' => $totalDefects,
                'recentDefects' => $recentDefects,
            ]];
        }
        if ($user->hasRole('maintenance')) {
            $totalRefair = Repair::count();
            $recentRefair = Repair::orderBy('created_at', 'desc')->take(5)->get();
            return ['pages.dashboard.maintenance', [
                'totalRefair' => $totalRefair,
                'recentRefair' => $recentRefair,
            ]];
        }
        $totaluser = User::count();
        return ['dashboard',[
            'totaluser' => $totaluser,
        ]];
    }

    public function getDataLeader(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $pemasanganData = Pemasangan::selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();

        $defectData = Defect::selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();

        $repairData = Repair::selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();

        $pemasanganData = $this->reformatDataKeys($pemasanganData);
        $defectData = $this->reformatDataKeys($defectData);
        $repairData = $this->reformatDataKeys($repairData);

        $jumlahPemasangan = array_sum($pemasanganData);
        $jumlahDefect = array_sum($defectData);
        $jumlahRepair = array_sum($repairData);

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        $days = array_map(function($day) {
            return str_pad($day, 2, '0', STR_PAD_LEFT);
        }, range(1, $daysInMonth));

        return response()->json([
            'pemasangan' => $jumlahPemasangan,
            'defects' => $jumlahDefect,
            'repairs' => $jumlahRepair,
            'pemasanganData' => $pemasanganData,
            'defectData' => $defectData,
            'repairData' => $repairData,
            'labels' => $days,
        ]);
    }

    private function reformatDataKeys($data)
    {
        $formattedData = [];
        foreach ($data as $key => $value) {
            $formattedData[str_pad($key, 2, '0', STR_PAD_LEFT)] = $value;
        }
        return $formattedData;
    }

}
