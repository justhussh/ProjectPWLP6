<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliah'; //mendefinisikan bahwa model ini terkait dengan tabel kelas

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswas_matakuliah', 'mahasiswa_id', 'matakuliah_id');
    }
    public function mahasiswas_matakuliah()
    {
        return $this->belongsToMany(Mahasiswa_Matakuliah::class);
    }
}