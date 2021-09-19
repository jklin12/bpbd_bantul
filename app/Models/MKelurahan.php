<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKelurahan extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 't_kelurahan';
    protected $primaryKey = 'kelurahan_id';

    public $timestamps = false;

    protected $fillable = [
        'kecamatan_id', 'name'
    ];
}
