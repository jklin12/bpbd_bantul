<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MBencana;
use App\Models\MKecamatan;
use App\Models\MKelurahan;
use Carbon\Carbon;

class Bencana extends Controller
{
    public function index()
    {
        /// mengambil data terakhir dan pagination 5 list
        $bencana = MBencana::select('t_kecamatan.name as nama_kec', 't_kelurahan.name as name_kel', 'deskripsi', 'type', 'created_at')
            ->leftJoin('t_kecamatan', 't_bencana.kecamatan', '=', 't_kecamatan.kecamatan_id')
            ->leftJoin('t_kelurahan', 't_bencana.kelurahan', '=', 't_kelurahan.kelurahan_id')
            ->orderByDesc('created_at')
            ->paginate(10);


        return view('bencana.index', compact('bencana'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add(Request $request)
    {
        $method = $request->method();
        $kecamatan = MKecamatan::all();

        if ($request->isMethod('post')) {

            $img = '';
            foreach ($request['images'] as $key => $value) {
                $img .= $value . ',';
            }
            $request['images'] = $img;

            $insert = MBencana::create($request->all());

            if ($insert) {
                return redirect()->route('bencana')
                    ->with('success', 'Tambah Data Berhasil');
            }
            die();
        }

        return view('bencana.add', compact('kecamatan'));
    }

    public function getKelurahan($id)
    {
        $kelurahan = MKelurahan::where('kecamatan_id', $id)->get();

        echo json_encode($kelurahan);
    }
}
