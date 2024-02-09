<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'nama'
    ];

    public function materis()
    {
        return $this->hasMany(Materi::class, 'id_kategori');
    }

    public function kuises()
    {
        return $this->hasMany(Kuis::class, 'id_kategori');
    }
}
