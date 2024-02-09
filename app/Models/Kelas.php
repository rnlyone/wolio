<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'tingkat',
        'nama_kelas'
    ];

    public function siswas()
    {
        return $this->hasMany(User::class, 'id_kelas')->where('role', 'siswa');
    }

}
