<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'id_user',
        'id_kuis',
        'jumlah_benar',
        'jumlah_salah'
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
