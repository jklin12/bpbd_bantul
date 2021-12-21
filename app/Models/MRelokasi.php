<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MRelokasi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 't_relokasi';
    protected $primaryKey = 'relokasi_id';

    protected $fillable = [
        'relokasi_tanggal', 'relokasi_name', 'relokasi_asal', 'relokasi_luas', 'relokasi_jumlah_jiwa','relokasi_status_tanah','relokasi_sarana_prasarana', 'relokasi_lokasi', 'relokasi_keterangan' 
    ];

}
