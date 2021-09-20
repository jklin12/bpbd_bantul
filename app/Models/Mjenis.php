<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mjenis extends Model
{
    use HasFactory;

    protected $table = 't_jenis';
    protected $primaryKey = 'jenis_id';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
