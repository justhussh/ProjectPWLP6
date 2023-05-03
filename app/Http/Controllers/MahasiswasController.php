<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Mahasiswa_Matakuliah;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Http\Request;
Route::resource('mahasiswa', MahasiswaController::class);
     * @return \Illuminate\Http\Response
     */
    // Praktikum 9
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        $mahasiswas = Mahasiswa::all(); // Mengambil 5 isi tabel
        return view('mahasiswas.index', compact('mahasiswas'));
        // return view('mahasiswas.index', compact('mahasiswas'));
    }

    // Praktikum 7
    // public function index()
    // {
    //     //fungsi eloquent menampilkan data menggunakan pagination
    //     $mahasiswas = Mahasiswa::paginate(5); // Mengambil 5 isi tabel
    //     $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
    //     return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    // }
    public function create()
    {
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswas.create', ['kelas' => $kelas]);
    }
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Tanggal_Lahir' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
        ]);

        //fungsi eloquent untuk menambah data
        $mahasiswas = new Mahasiswa;
        $mahasiswas->Nim = $request->get('Nim');
        $mahasiswas->Nama = $request->get('Nama');
        $mahasiswas->Tanggal_Lahir = $request->get('Tanggal_Lahir');
        $mahasiswas->Jurusan = $request->get('Jurusan');
        $mahasiswas->No_Handphone = $request->get('No_Handphone');
        $mahasiswas->Email = $request->get('Email');

        // fungsi eloquent untuk menambah data dengan relasi belongs to
        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($Nim);
        $kelas = Kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa', 'kelas'));
    }

    // Praktikum 7
    // public function edit($Nim)
    // {
    //     //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
    //     $Mahasiswa = Mahasiswa::find($Nim);
    //     return view('mahasiswas.edit', compact('Mahasiswa'));
    // }
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Tanggal_Lahir' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
        ]);
        //fungsi eloquent untuk mengupdate data inputan kita
        $mahasiswas = Mahasiswa::find($Nim);
        $mahasiswas->Nim = $request->get('Nim');
        $mahasiswas->Nama = $request->get('Nama');
        $mahasiswas->Tanggal_Lahir = $request->get('Tanggal_Lahir');
        $mahasiswas->Jurusan = $request->get('Jurusan');
        $mahasiswas->No_Handphone = $request->get('No_Handphone');
        $mahasiswas->Email = $request->get('Email');

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    // Praktikum 7
    // public function update(Request $request, $Nim)
    // {
    //     //melakukan validasi data
    //     $request->validate([
    //         'Nim' => 'required',
    //         'Nama' => 'required',
    //         'Kelas' => 'required',
    //         'Jurusan' => 'required',
    //         'No_Handphone' => 'required',
    //     ]);
    //     //fungsi eloquent untuk mengupdate data inputan kita
    //     Mahasiswa::find($Nim)->update($request->all());
    //     //jika data berhasil diupdate, akan kembali ke halaman utama
    //     return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    // }
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    // public function search(Request $request)
    // {
    //     $keyword = $request->search;
    //     $mahasiswas = Mahasiswa::where('Nama', 'like', '%' . $keyword . '%')->paginate(5);
    //     return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    // }

    public function khs($Nim)
    {
        //$Mahasiswa = Mahasiswa::find($nim);
        $Mahasiswa = Mahasiswa::find($Nim);
        $Matakuliah = Matakuliah::all();
        //$MataKuliah = $Mahasiswa->MataKuliah()->get();
        $Mahasiswa_Matakuliah = Mahasiswa_MataKuliah::where('mahasiswa_id', '=', $Nim)->get();
        return view('mahasiswas.khs', ['Mahasiswa' => $Mahasiswa], ['Mahasiswa_Matakuliah' => $Mahasiswa_Matakuliah], ['Matakuliah' => $Matakuliah], compact('Mahasiswa_Matakuliah'));
    }
};