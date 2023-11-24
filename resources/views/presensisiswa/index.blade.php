@extends('layout.layout')
@section('title', 'Daftar Presensi')
@section('content')
<style>
    body {
        background-color: #98E4FF;
    }

    .btnunduh {
        background-color: #CBCDF2;
    }

    .btnunduh:hover {
        background-color: #abacc7;
    }

    canvas {
        background-color: #eee;
        width: 10px;
    }
</style>

<div class="container">
    <h1 class="content-header">Daftar Presensi</h1>
    <div class="col-md-2 d-flex justify-content-end mt-3">

        <a href="presensi/unduh" style="margin-right: 10px; z-index: 2">
            <btn class="btn btn-success button btntambah btnunduh">Unduh PDF
                <img src="{{asset('img/unduh.png')}}" style="max-width: 20px;">
            </btn>

        </a>
        <span></span>
        @if (Auth::check() && Auth::user()->role == 'gurupiket' || Auth::check() && Auth::user()->role == 'walikelas')
        <a href="presensi/tambah">
            <btn class="btn btn-success button btntambah">Tambah Presensi</btn>
        </a>
        @endif

    </div>
    <table class="bootstrap-table table table-bordered DataTable">
        <thead>
            <tr>
                <th scope="col" class="thead">No</th>
                <th scope="col" class="thead">Nama Siswa</th>
                <th scope="col" class="thead">Tanggal</th>
                <th scope="col" class="thead">Status</th>
                <th scope="col" class="thead">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensi as $p)
            <tr>
                <td>{{$loop->iteration}}</td>

                <td>{{ $p->nama_siswa }}</td>
                <td>{{ $p->tanggal_presensi }}</td>
                <td>{{ $p->status_hadir }}</td>
                <td class="listbtn">
                    <a href="presensi/detail/{{$p->id_presensi}}" class="btn btn-sm button btnDetail">
                        <p>Detail</p>
                    </a>
                    @if (Auth::check() && Auth::user()->role == 'gurupiket' || Auth::check() && Auth::user()->role == 'walikelas')
                    <a href="presensi/edit/{{$p->id_presensi}}">
                        <p class="btn btn-sm button btnEdit">Edit</p>
                    </a>
                    <btn class="btn btn-sm button btnHapus" idHapus="{{ $p->id_presensi }}">Hapus</btn>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<canvas id="chartJSContainer" style="width: 50%;"></canvas>
@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-dragdata@2.0.2/dist/chartjs-plugin-dragdata.min.js"></script>
<script type="module">
    $('.DataTable tbody').on('click', '.btnHapus', function(a) {
        a.preventDefault();
        let idHapus = $(this).closest('.btnHapus').attr('idHapus');
        swal.fire({
            title: "Apakah anda ingin menghapus data ini?",
            showCancelButton: true,
            confirmButtonText: 'Setuju',
            cancelButtonText: `Batal`,
            confirmButtonColor: 'red'

        }).then((result) => {
            if (result.isConfirmed) {
                //Ajax Delete
                $.ajax({
                    type: 'DELETE',
                    url: 'presensi/hapus',
                    data: {
                        id_presensi: idHapus,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success) {
                            swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                //Refresh Halaman
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        $('.DataTable').DataTable();
    });


    var options = {
        type: 'bar',
        data: {
            labels: ['Risk Level'],
            datasets: [{
                    label: 'Low',
                    data: [],
                    backgroundColor: '#D6E9C6',
                },
                {
                    label: 'Moderate',
                    data: [20.7],
                    backgroundColor: '#FAEBCC',
                },
                {
                    label: 'High',
                    data: [11.4],
                    backgroundColor: '#EBCCD1',
                }
            ]
        },
        options: {
            responsive: false,
            onHover: function(e) {
                const point = e.chart.getElementsAtEventForMode(e, 'nearest', {
                    intersect: true
                }, false)
                if (point.length) e.native.target.style.cursor = 'grab'
                else e.native.target.style.cursor = 'default'
            },
            plugins: {
                dragData: {
                    round: 1,
                    showTooltip: true,
                    onDragStart: function(e) {
                        // console.log(e)
                    },
                    onDrag: function(e, datasetIndex, index, value) {
                        e.target.style.cursor = 'grabbing'
                        // prohibit values < 0
                        if (value < 0) return false
                        // console.log(e, datasetIndex, index, value)
                    },
                    onDragEnd: function(e, datasetIndex, index, value) {
                        e.target.style.cursor = 'default'
                        // console.log(datasetIndex, index, value)
                    },
                }
            },
            scales: {
                x: {
                    stacked: true,
                    max: 100,
                    min: 0
                },
                y: {
                    stacked: true,
                    max: 100,
                    min: 0
                }
            }
        }
    }

    var ctx = document.getElementById('chartJSContainer').getContext('2d');
    window.test = new Chart(ctx, options);
</script>
@endsection