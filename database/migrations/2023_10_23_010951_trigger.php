<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER add_siswa
        BEFORE INSERT ON siswa
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("siswa", CURDATE(), CURTIME(), "Tambah", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER update_siswa
        AFTER UPDATE ON siswa
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("siswa", CURDATE(), CURTIME(), "Update", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER delete_siswa
        AFTER DELETE ON siswa
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("siswa", CURDATE(), CURTIME(), "Hapus", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER add_pengurus
        BEFORE INSERT ON pengurus_kelas
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("pengurus_kelas", CURDATE(), CURTIME(), "Tambah", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER update_pengurus
        AFTER UPDATE ON pengurus_kelas
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("pengurus_kelas", CURDATE(), CURTIME(), "Update", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER delete_pengurus
        AFTER DELETE ON pengurus_kelas
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("pengurus_kelas", CURDATE(), CURTIME(), "Hapus", "Sukses");
        END
        ');

        

        DB::unprepared('
        CREATE TRIGGER add_presensi
        BEFORE INSERT ON presensi_siswa
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("presensi_siswa", CURDATE(), CURTIME(), "Tambah", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER update_presensi
        AFTER UPDATE ON presensi_siswa
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("presensi_siswa", CURDATE(), CURTIME(), "Update", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER delete_presensi
        AFTER DELETE ON presensi_siswa
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("presensi_siswa", CURDATE(), CURTIME(), "Hapus", "Sukses");
        END
        ');





        DB::unprepared('
        CREATE TRIGGER add_kelas
        BEFORE INSERT ON kelas
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("kelas", CURDATE(), CURTIME(), "Tambah", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER update_kelas
        AFTER UPDATE ON kelas
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("kelas", CURDATE(), CURTIME(), "Update", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER delete_kelas
        AFTER DELETE ON kelas
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("kelas", CURDATE(), CURTIME(), "Hapus", "Sukses");
        END
        ');





        DB::unprepared('
        CREATE TRIGGER add_guru
        BEFORE INSERT ON guru
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("guru", CURDATE(), CURTIME(), "Tambah", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER update_guru
        AFTER UPDATE ON guru
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("guru", CURDATE(), CURTIME(), "Update", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER delete_guru
        AFTER DELETE ON guru
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("guru", CURDATE(), CURTIME(), "Hapus", "Sukses");
        END
        ');







        DB::unprepared('
        CREATE TRIGGER add_akun
        BEFORE INSERT ON tbl_user
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("akun", CURDATE(), CURTIME(), "Tambah", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER update_akun
        AFTER UPDATE ON tbl_user
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("akun", CURDATE(), CURTIME(), "Update", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER delete_akun
        AFTER DELETE ON tbl_user
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("akun", CURDATE(), CURTIME(), "Hapus", "Sukses");
        END
        ');

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
