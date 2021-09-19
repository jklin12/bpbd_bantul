<?php

namespace App\Http\Controllers;

use App\Models\MKecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatan = MKecamatan::paginate(10);

        return view('kecamatan.index', compact('kecamatan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        ]);

        MKecamatan::create($request->all());

        /// redirect jika sukses menyimpan data
        return redirect()->route('kecamatan.index')
            ->with('success', 'Tambah Kecamatan berhasil .');
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
    public function update(Request $request, MKecamatan $kecamatan)
    { 
        $request->validate([
            'name' => 'required',
        ]);
 

        $kecamatan->update($request->all());

        /// redirect jika sukses menyimpan data
        return redirect()->route('kecamatan.index')
            ->with('success', 'Edit Kecamatan berhasil .');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MKecamatan $kecamatan)
    {
        $kecamatan->delete();

        return redirect()->route('kecamatan.index')
        ->with('success', 'Hapus Kecamatan berhasil .');
    }
}
