<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMBencanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_bencana', function (Blueprint $table) {
            $table->id();
            $table->integer('kecamatan');
            $table->integer('kelurahan');
            $table->text('deskripsi');
            $table->integer('type');
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('tinggi');
            $table->text('foto');
            $table->string('alamat');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_bencana');
    }
}
