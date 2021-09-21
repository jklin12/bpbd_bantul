<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MBencana;
use App\Models\MKecamatan;
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
                ->format('d, M y');

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
            $pieChart[$c->jenis]['color'] =  $this->rand_color();
        }


        $pieJenis = "";
        $pieCount = "";
        $pieColor = "";
        foreach ($pieChart as $l) {
            $pieJenis .= "'" . $l['jenis'] . "',";
            $pieColor .= "'" . $l['color'] . "',";
            $pieCount .= $l['data'] . ',';
        }

        $bencanaBar = MKecamatan::select(DB::raw('count(t_bencana.id) as jumlah,t_kecamatan.name as nama_kecamatan'))
            ->leftJoin('t_bencana', 't_kecamatan.kecamatan_id', '=', 't_bencana.kecamatan')
            ->where('deleted_at', null)
            ->groupBy('nama_kecamatan')
            ->get();

        $barChart = [];

        foreach ($bencanaBar as $d) {
            $barChart[$d->nama_kecamatan]['kecamatan'] = $d->nama_kecamatan;
            $barChart[$d->nama_kecamatan]['data'] =  $d->jumlah;
        }

        $barKecamatan = "";
        $barCount = "";
        $barColor = "";
        foreach ($barChart as $j) {
            $barKecamatan .= "'" . $j['kecamatan'] . "',";
            $barCount .= $j['data'] . ',';
            $barColor .= "'" .  $this->rand_color() . "',";
        }



        $data = [
            "line_date" => $lineDate,
            "line_data" => $lineCount,
            "pie_jenis" => $pieJenis,
            "pie_data" => $pieCount,
            "pie_color" => $pieColor,
            "raw_pie" => $pieChart,
            "bar_kecamatan" => $barKecamatan,
            "bar_count" => $barCount,
            "bar_color" => $barColor
        ];

        return view('vHome', compact('data'));
    }

    private function rand_color()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
