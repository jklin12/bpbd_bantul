<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    public function index()
    {
        $bencana = MBencana::select(DB::raw('created_at,count(*) as jumlah'))
            ->where('deleted_at', null)
            ->groupBy('created_at')
            ->get();

        $lineChart = []; 
        foreach ($bencana as $b) {

            $date = \Carbon\Carbon::parse($b->created_at)
                ->format('Y-m-d');

            $lineChart[$date]['tanggal'] = $date;
            $lineChart[$date]['data'] =  $b->jumlah;
        }
        $lineDate = "";
        $lineCount = "";
        foreach ($lineChart as $l) {
            $lineDate .= "'" . $l['tanggal'] . "',";
            $lineCount .= $l['data'] . ',';
        }

        $bencanaPie = MBencana::select(DB::raw('count(*) as jumlah,t_jenis.name as jenis'))
            ->leftJoin('t_jenis', 't_bencana.type', '=', 't_jenis.jenis_id')
            ->where('deleted_at', null)
            ->groupBy('jenis')
            ->get();

        $pieChart = []; 

        foreach ($bencanaPie as $c) { 
            $pieChart[$c->jenis]['jenis'] = $c->jenis;
            $pieChart[$c->jenis]['data'] =  $c->jumlah;
        }

        $pieJenis = "";
        $pieCount = "";
        foreach ($pieChart as $l) {
            $pieJenis .= "'" . $l['jenis'] . "',";
            $pieCount .= $l['data'] . ',';
        }
        $data = [
            "line_date" => $lineDate,
            "line_data" => $lineCount,
            "pie_jenis" => $pieJenis,
            "pie_data" => $pieCount,
            "raw_pie" => $pieChart
        ];

        return view('vHome', compact('data'));
    }
}
