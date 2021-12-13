<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mperbaikan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 't_perbaikan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'bencana_id','status', 'deskripsi'
    ];

}
