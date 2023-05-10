@extends('mahasiswas.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <br><br>
                <center>
                    <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2><br>
                </center>
            </div>
            {{-- <div class="float-right my-2">
                
            </div> --}}
            <form class="form-left my-4" method="get" action="{{ route('search') }}">
                <div class="form-group w-100 mb-3">
                    <a class="btn btn-success" href="{{ route('mahasiswas.create') }}"> Input
                        Mahasiswa</a>
                </div>
            </form>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
    <table id="table" class="table table-bordered">
        <thead class="table-dark">

            <tr>
                <th>Nim</th>
                <th>Nama</th>
                <th>Foto</th>
                <th>TTL</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>No_Handphone</th>
                <th>Email</th>
                <th style="width:40%">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($mahasiswas as $Mahasiswa)
                <tr>
                    <td>{{ $Mahasiswa->Nim }}</td>
                    <td>{{ $Mahasiswa->Nama }}</td>
                    <td><img width="100px" src="{{asset('storage/' . $Mahasiswa->featured_image) }}"></td>
                    <td>{{ $Mahasiswa->Tanggal_Lahir }}</td>
                    <td>{{ $Mahasiswa->Kelas->nama_kelas }}</td>
                    <td>{{ $Mahasiswa->Jurusan }}</td>
                    <td>{{ $Mahasiswa->No_Handphone }}</td>
                    <td>{{ $Mahasiswa->Email }}</td>
                    <td>
                        <form action="{{ route('mahasiswas.destroy', $Mahasiswa->Nim) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('mahasiswas.show', $Mahasiswa->Nim) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('mahasiswas.edit', $Mahasiswa->Nim) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <a class="btn btn-warning" href="{{ route('khs', $Mahasiswa->Nim) }}">Nilai</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {!! $mahasiswas->withQueryString()->links('pagination::bootstrap-5') !!} --}}
@endsection