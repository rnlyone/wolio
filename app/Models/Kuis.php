<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori',
        'uuid',
        'nama',
    ];


    public function riwayats()
    {
        return $this->hasMany(Riwayat::class, 'id_kuis');
    }

    public function soals()
    {
        return $this->hasMany(Soal::class, 'id_kuis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
