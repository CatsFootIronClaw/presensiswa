@extends('layout.layout')
@section('title', 'Edit Presensi')
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
        margin-bottom: 20px;
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
                    Edit Presensi
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="simpan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Siswa</label>
                                <input type="text" class="form-control" disabled value="{{$presensi[0]->nama_siswa}}">
                                <label>Status</label>
                                <select name="status_hadir" class="form-control">
                                    <option value="Hadir" {{ $presensi[0]->status_hadir === "Hadir" ? 'selected' : '' }}>Hadir</option>
                                    <option value="Izin" {{ $presensi[0]->status_hadir === "Izin" ? 'selected' : '' }}>Izin</option>
                                    <option value="Alpha" {{ $presensi[0]->status_hadir === "Alpha" ? 'selected' : '' }}>Alpha</option>
                                </select>
                                <label>Foto Bukti</label>
                                <input type="hidden" class="form-control" name="id_presensi" value="{{$presensi[0]->id_presensi}}" />
                                <input type="file" class="form-control" name="foto_bukti" />
                                @csrf
                            </div>
                            <div class="col-md-5 mt-3 d-flex">
                                <button type="submit" class="btn btn-sm button btnSimpan">SIMPAN</button>
                                <span style="width: 10px;"></span>
                                <a href="#" onclick="window.history.back();" class="btn btn-sm button btnDetail ">KEMBALI</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection