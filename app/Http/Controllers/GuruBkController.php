<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Logs;
use App\Models\PresensiSiswa;
use App\Models\tbl_user;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class GuruBkController extends Controller
{
    public function profilGuru(Tbl_user $tbl_user)
    {
        $auth = Auth::user();
        $fotoprofil = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->where('guru.id_user', $auth->id_user)->get();

        $data = [
            'akun' => $tbl_user
                ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
                ->where('guru.id_user', $auth->id_user)->get(),
            'foto_profil' => $fotoprofil[0]
        ];

        // dd($data);
        return view('profil.profilguru', $data);
    }

    public function indexSiswa(Siswa $siswa, tbl_user $tbl_user)
    {
        $auth = Auth::user();
        $fotoprofil = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->where('guru.id_user', $auth->id_user)->get();
        $tampilkan_siswa = DB::select(' SELECT * from view_siswa');
        $totalsiswa = DB::select('SELECT CountSiswa() AS TotalSiswa');

        // array untuk menangkap data siswa dari view dan 
        // menangkap data jumlah siswa dari stored function
        $data = [
            'siswa' => $tampilkan_siswa,
            // 'siswa' => $siswa->all(),
            'jumlah_siswa' => $totalsiswa[0]->TotalSiswa,
            'foto_profil' => $fotoprofil[0]
        ];

        return view('siswa.index', $data);
    }

    public function detailSiswa(Request $request, Siswa $siswa, tbl_user $tbl_user)
    {
        $auth = Auth::user();
        $fotoprofil = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->where('guru.id_user', $auth->id_user)->get();
        $data = [
            'detail' => $siswa->where('nis', $request->id)
                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->get(),
            'foto_profil' => $fotoprofil[0]
        ];
        // dd($data);
        return view('siswa.detail', $data);
    }

    
    public function detailKelas(Request $request, tbl_user $tbl_user)
    {
        $auth = Auth::user();
        $fotoprofil = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->where('guru.id_user', $auth->id_user)->get();
        $detailkelas = DB::table('view_kelas')->where('id_kelas', $request->id)->get();
        $jumlahsiswa = DB::table('kelas')->select(DB::raw('COUNT(*) as JumlahSiswa'))
        ->join('siswa', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ->where('siswa.id_kelas', $request->id)->get();
        $data = [
            'detail' => $detailkelas,
            'jumlahsiswa' => $jumlahsiswa[0]->JumlahSiswa,
            'foto_profil' => $fotoprofil[0]
        ];
        // dd($data);
        return view('Kelas.detail', $data);
    }

    public function indexPresensi(tbl_user $tbl_user)
    {
        $auth = Auth::user();
        $fotoprofil = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->where('guru.id_user', $auth->id_user)->get();
        $data = [
            'foto_profil' => $fotoprofil[0],
            'presensi' => DB::table('view_presensi')->get()
        ];
        return view('presensisiswa.index', $data);
    }

    public function detailPresensi(Request $request, PresensiSiswa $presensi, tbl_user $tbl_user)
    {
        $auth = Auth::user();
        $fotoprofil = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->where('guru.id_user', $auth->id_user)->get();
        $data = [
            'detail' => $presensi->where('id_presensi', $request->id)
                ->join('siswa', 'presensi_siswa.nis', '=', 'siswa.nis')
                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->get(),
            'foto_profil' => $fotoprofil[0]
        ];
        // dd($data);
        return view('presensisiswa.detail', $data);
    }

    public function unduhPresensi(PresensiSiswa $presensi)
    {
        $presensi = $presensi
            ->join('siswa', 'presensi_siswa.nis', '=', 'siswa.nis')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->get();
        $pdf = PDF::loadView('presensisiswa.unduh', ['presensi' => $presensi]);
        return $pdf->download('data-presensi.pdf');
    }

    public function indexKelas(Kelas $kelas, tbl_user $tbl_user)
    {
        $auth = Auth::user();
        $fotoprofil = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->where('guru.id_user', $auth->id_user)->get();
        $data = [
            'kelas' => $kelas
            ->join('wali_kelas', 'kelas.id_walas', '=', 'wali_kelas.id_walas')
            ->join('guru', 'wali_kelas.id_guru', '=', 'guru.id_guru')->get(),
            'foto_profil' => $fotoprofil[0]
        ];
        return view('kelas.index', $data);
    }

    public function indexLogs(Logs $logs, tbl_user $tbl_user)
    {
        $auth = Auth::user();
        $fotoprofil = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->where('guru.id_user', $auth->id_user)->get();

        $data = [
            'logsy' => $logs::orderBy('id_log', 'desc')->get(),
            'foto_profil' => $fotoprofil[0]
        ];

        return view('logs.index', $data);
    }
}
