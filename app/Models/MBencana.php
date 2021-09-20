<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MBencana extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 't_bencana';

    protected $fillable = [
        'kecamatan', 'kelurahan', 'deskripsi', 'type', 'panjang','lebar','tinggi', 'foto', 'alamat'
    ];

 
}
