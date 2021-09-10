<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKelurahan extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 't_kelurahan';

    protected $fillable = [
        'kecamatan_id', 'name'
    ];
}
