<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class MBencana extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 't_bencana';

    protected $fillable = [
        'kecamatan', 'kelurahan', 'deskripsi', 'type', 'size', 'foto', 'alamat'
    ];

    public function getCreatedAtAttribute()
    {
        if ($this->attributes['created_at'] != null) {
            return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('d, M Y H:i');
        }
      
    }
}
