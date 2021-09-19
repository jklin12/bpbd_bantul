<?php

namespace App\Http\Controllers;

use App\Models\MKelurahan;
use Illuminate\Http\Request;
use Kelurahan;

class DataMaster extends Controller
{
   public function kelurahan(){

    $kelurahan = MKelurahan::latest()->paginate(10);

    return view('kelurahan.index',compact('kelurahan'))
    ->with('i', (request()->input('page', 1) - 1) * 5);
   }
}
