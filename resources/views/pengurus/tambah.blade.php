@extends('layout.layout')
@section('title', 'Tambah Pengurus')
@section('content')
<style>
    body {
        background-color: #98E4FF;
    }

    .card-header .h1 {
        font-weight: 600;
        opacity: 60%;
    }

    .form-control {
        opacity: 80%;
    }

    label {
        font-weight: 700;
        font-size: medium;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header content-header">
                <span class="h1">
                    Tambah Pengurus
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="simpan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Siswa</label>
                                <select name="nis" class="form-control">
                                    @foreach ($siswa as $s)
                                    <option value="{{ $s->nis }}">{{ $s->nama_siswa }}
                                    </option>
                                    @endforeach
                                </select>
                                <br>
                                <label>Jabatan</label>
                                <select name="jabatan" class="form-control">
                                    <option value="default" hidden>pilih jabatan</option>
                                    <option value="Ketua kelas">Ketua kelas</option>
                                    <option value="Wakil kelas">Wakil kelas</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Bendahara">Bendahara</option>
                                </select>
                                @csrf
                            </div>
                            <div class="col-md-5 mt-3 d-flex">
                                <button type="submit" class="btn btn-sm button btnSimpan">SIMPAN</button>
                                <span style="width: 10px;"></span>
                                <a href="#" onclick="window.history.back();" class="btn btn-sm button btnDetail">KEMBALI</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection