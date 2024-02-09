<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kuis',
        'soal',
        'jawaban_benar'
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }

    public function jawabans()
    {
        return $this->hasMany(Jawaban::class, 'id_soal');
    }

    public function jawaban_benar()
    {
        return $this->hasOne(Jawaban::class, 'jawaban_benar');
    }

    public function audios()
    {
        return $this->hasMany(Audio::class, 'id_soal');
    }
}
