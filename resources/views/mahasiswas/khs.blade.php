@extends('mahasiswas.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div style="text-align: center">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
                <h3 style="margin-top: 20px; ">Kartu Hasil Studi (KHS)</h3>
            </div>

            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Nama: </b>{{ $Mahasiswa->Nama }}</li>
                    <li class="list-group-item"><b>Nim: </b>{{ $Mahasiswa->Nim }}</li>
                    <li class="list-group-item"><b>Kelas: </b>{{ $Mahasiswa->kelas->nama_kelas }}</li>
                    <li class="list-group-item"><b>Jurusan: </b>{{ $Mahasiswa->Jurusan }}</li>
                </ul><br>
                <div>
                    <table class="table table-hover">
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Nilai</th>
                        </tr>
                        @foreach ($Mahasiswa_Matakuliah as $MhsMatkul)
                            <tr>
                                <td>{{ $MhsMatkul->matakuliah->nama_matkul }}</td>
                                <td>{{ $MhsMatkul->matakuliah->sks }}</td>
                                <td>{{ $MhsMatkul->matakuliah->semester }}</td>
                                <td>{{ $MhsMatkul->nilai }}</td>
                        @endforeach
                        </tr>
                    </table>
                </div>
                <a class="btn btn-secondary mt-3" href="{{ route('mahasiswas.index') }}">Kembali</a>
                <a class="btn btn-success mt-3" href="{{ route('print_pdf', $Mahasiswa->Nim) }}">Cetak ke PDF</a>
            </div>
        </div>
    </div>
@endsection
