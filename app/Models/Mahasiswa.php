<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent

class Mahasiswa extends Model //Definisi Model
{
    protected $table = "mahasiswas"; // Eloquent akan membuat model mahasisw menyimpan record di tabel mahasiswas
    public $timestamps = false;
    protected $primaryKey = 'Nim'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable.
     * *
     * @var array
     */
    protected $fillable = [
        'Nim',
        'Nama',
        'Tanggal_Lahir',
        'kelas_id',
        'Jurusan',
        'No_Handphone',
        'Email',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    // public function mahasiswas_matakuliah()
    // {
    //     return $this->belongsToMany(Mahasiswa_Matakuliah::class);
    // }
    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'mahasiswas_matakuliah', 'mahasiswa_id', 'matakuliah_id');
    }
};