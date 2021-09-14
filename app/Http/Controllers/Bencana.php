<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MBencana;
use App\Models\MKecamatan;
use App\Models\MKelurahan;
use Carbon\Carbon;
use Hamcrest\Arrays\IsArray;

class Bencana extends Controller
{
    public function index()
    {
        /// mengambil data terakhir dan pagination 5 list
        $bencana = MBencana::select('t_kecamatan.name as nama_kec', 't_kelurahan.name as name_kel', 't_bencana.id', 'deskripsi', 'type', 'created_at')
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
            if (is_array($request['images'])) {
                foreach ($request['images'] as $key => $value) {
                    $img .= $value . ',';
                }
            }

            $request['foto'] = $img;

            $insert = MBencana::create($request->all());

            if ($insert) {
                return redirect()->route('bencana')
                    ->with('success', 'Tambah Data Berhasil');
            }
        }

        return view('bencana.add', compact('kecamatan'));
    }

    public function edit($id, Request $request)
    {
        $bencana = MBencana::select('t_kecamatan.name as nama_kec', 't_kelurahan.name as name_kel', 't_kecamatan.kecamatan_id', 't_bencana.*')
            ->leftJoin('t_kecamatan', 't_bencana.kecamatan', '=', 't_kecamatan.kecamatan_id')
            ->leftJoin('t_kelurahan', 't_bencana.kelurahan', '=', 't_kelurahan.kelurahan_id')
            ->where('id', $id)
            ->orderByDesc('created_at')
            ->first();

        $kecamatan = MKecamatan::all();
        $kelurahan = MKelurahan::where('kecamatan_id', $bencana['kecamatan_id'])->get();

        if ($request->isMethod('post')) {

            $update = MBencana::find($id)
                ->update($request->all());
            if ($update) {
                return redirect()->route('bencanaDetail', $id)
                    ->with('success', 'Edit Data Berhasil');
            }
        }

        $data = [
            'kecamatan'  => $kecamatan,
            'kelurahan' => $kelurahan,
            'bencana' => $bencana
        ];

        return view('bencana.edit', compact('data'));
    }

    public function delete($id)
    {
        $delete = MBencana::find($id)
            ->delete();
        if ($delete) {
            return redirect()->route('bencana')
                ->with('success', 'Hapus Data Berhasil');
        }
    }

    public function detail($id)
    {
        $bencana = MBencana::select('t_kecamatan.name as nama_kec', 't_kelurahan.name as name_kel', 't_bencana.*')
            ->leftJoin('t_kecamatan', 't_bencana.kecamatan', '=', 't_kecamatan.kecamatan_id')
            ->leftJoin('t_kelurahan', 't_bencana.kelurahan', '=', 't_kelurahan.kelurahan_id')
            ->where('id', $id)
            ->orderByDesc('created_at')
            ->first();
        $foto = explode(',', $bencana['foto']);
        $bencana['foto'] = $foto;

        return view('bencana.detail', compact('bencana'));
    }

    public function getKelurahan($id)
    {
        $kelurahan = MKelurahan::where('kecamatan_id', $id)->get();


        echo json_encode($kelurahan);
    }
}
