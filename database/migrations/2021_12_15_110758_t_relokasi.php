<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TRelokasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_relokasi', function (Blueprint $table) {
            $table->id('relokasi_id'); 
            $table->date('relokasi_tanggal');
            $table->string('relokasi_name');
            $table->string('relokasi_asal');
            $table->string('relokasi_luas');
            $table->string('relokasi_jumlah_jiwa');
            $table->string('relokasi_status_tanah');
            $table->string('relokasi_sarana_prasarana');
            $table->string('relokasi_lokasi');
            $table->string('relokasi_keterangan'); 
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_relokasi');
    }
}
