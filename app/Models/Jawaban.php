<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_soal',
        'jenis',
        'jawaban'
    ];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal');
    }
}
