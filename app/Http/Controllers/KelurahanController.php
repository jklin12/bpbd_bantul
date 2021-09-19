<?php

namespace App\Http\Controllers;

use App\Models\MKecamatan;
use App\Models\MKelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahan = MKelurahan::select('t_kelurahan.name as name_kelurahan', 't_kecamatan.name as name_kecamatan', 'kelurahan_id', 't_kelurahan.kecamatan_id')
            ->leftJoin('t_kecamatan', 't_kelurahan.kecamatan_id', '=', 't_kecamatan.kecamatan_id')
            ->paginate(10);
        $kecamatan = MKecamatan::get();


        $data = [
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan
        ];

        return view('kelurahan.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'kecamatan_id' => 'required',
        ]);

        MKelurahan::create($request->all());

        /// redirect jika sukses menyimpan data
        return redirect()->route('kelurahan.index')
            ->with('success', 'Tambah kelurahan berhasil .');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MKelurahan $kelurahan)
    {
        $request->validate([
            'name' => 'required',
        ]);
 

        $kelurahan->update($request->all());

        /// redirect jika sukses menyimpan data
        return redirect()->route('kelurahan.index')
            ->with('success', 'Edit kelurahan berhasil .');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MKelurahan $kelurahan)
    {
        $kelurahan->delete();

        return redirect()->route('kelurahan.index')
        ->with('success', 'Hapus kelurahan berhasil .');
    }
}
