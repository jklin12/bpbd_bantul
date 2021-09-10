<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKecamatan extends Model
{
    use HasFactory;

    protected $table = 't_kecamatan';

    protected $fillable = [
        'name'
    ];
}
