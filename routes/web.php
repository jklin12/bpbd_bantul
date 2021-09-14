<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Home;
use App\Http\Controllers\Bencana;
use App\Http\Controllers\Upload;

Route::get('/', [Authentication::class, 'showFormLogin'])->name('login');
Route::get('login', [Authentication::class, 'showFormLogin'])->name('login');
Route::post('login', [Authentication::class, 'login']);



Route::group(['middleware' => 'auth'], function () {

    Route::get('home', [Home::class, 'index'])->name('home');
    Route::get('logout', [Authentication::class, 'logout'])->name('logout');
    Route::get('bencana', [Bencana::class, 'index'])->name('bencana');
    Route::get('bencana/{id}', [Bencana::class, 'detail'])->name('bencanaDetail');
    Route::get('addBencana', [Bencana::class, 'add'])->name('addBencana');
    Route::post('addBencana', [Bencana::class, 'add'])->name('doAddBencana');
    Route::get('editBencana/{id}', [Bencana::class, 'edit'])->name('editBencana');
    Route::post('editBencana/{id}', [Bencana::class, 'edit'])->name('doEditBencana');
    Route::get('deleteBencana/{id}', [Bencana::class, 'delete'])->name('deleteBencana');
    Route::get('getKelurahan/{id}', [Bencana::class, 'getKelurahan'])->name('getKelurahan');
    Route::get('getKelurahan/{id}', [Bencana::class, 'getKelurahan'])->name('getKelurahan');
    Route::post('file-upload',[Upload::class, 'index'])->name('fileupload');
});
