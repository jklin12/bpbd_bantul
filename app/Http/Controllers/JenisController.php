<?php

namespace App\Http\Controllers;

use App\Models\Mjenis;
use App\Models\MKecamatan;
use App\Models\MKelurahan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = Mjenis::paginate(10);

        return view('jenis.index', compact('jenis'))
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

        Mjenis::create($request->all());

        /// redirect jika sukses menyimpan data
        return redirect()->route('jenis.index')
            ->with('success', 'Tambah jenis berhasil .');
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
    public function update(Request $request, MKelurahan $jenis)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $jenis->update($request->all());
            return redirect()->route('jenis.index')
                ->with('success', 'Edit jenis berhasil .');
        } catch (QueryException $th) {
            $errorInfo = $th->errorInfo;
            echo $errorInfo;
        }
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mjenis $jenis)
    {
        $jenis->delete();

        return redirect()->route('jenis.index')
            ->with('success', 'Hapus jenis berhasil .');
    }
}
