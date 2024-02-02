<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // UKS
        $uksToday = Record::where('status', true)->count();
        $uksYesterday = Record::whereDate('created_at', Carbon::yesterday())->where('status', true)->count();
        // Calculate percentage growth
        // $percentageGrowth = $uksYesterday != 0 ? (($uksToday - $uksYesterday) / $uksYesterday) * 100 : 0;

        // Records
        $recordToday = Record::whereDate('created_at', today())->count();
        $recordYesterday = Record::whereDate('created_at', Carbon::yesterday())->count();
        // Calculate percentage growth
        // $percentageGrowthRecord = $recordYesterday != 0 ? (($recordToday - $recordYesterday) / $recordYesterday) * 100 : 0;

        $recordTotalSMP = Record::where('school', 'siswa-smp')->count();
        $recordTotalSMK = Record::where('school', 'siswa-smk')->count();

        $recordRecent = Record::whereDate('created_at', today())->orderBy('created_at', 'desc')->paginate();
        foreach ($recordRecent as $record) {
            $record->formattedDate = Carbon::parse($record->created_at)->isoFormat('dddd, ');
        }

        $diUksCount = Record::where('status', true)->count();
        $diUks = Record::paginate();

        return view('home', compact(
            'uksToday',
            'recordToday',
            'recordYesterday',
            'recordTotalSMP',
            'recordTotalSMK',
            'recordRecent',
            'uksYesterday',
            'diUksCount',
            'diUks'
        )
        );
    }
}
