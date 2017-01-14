<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KaryawanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        DB::table('master_toko')->delete();
        DB::table('jns_kelamin')->delete();
        DB::table('karyawan')->delete();
        DB::table('gaji_karyawan')->delete();
        DB::table('hutang_karyawan')->delete();
        DB::table('presensi_karyawan')->delete();

        DB::table('master_toko')->insert([
            [
                'nama_toko'  	=> 'Metro',
            ],
            [
                'nama_toko'  	=> 'Metro Jaya',
            ],
            [
                'nama_toko'  	=> 'Rajawali',
            ],
        ]);

        DB::table('jns_kelamin')->insert([
            [
                'jns_kelamin'  	=> 'Laki-Laki',
            ],
            [
                'jns_kelamin'  	=> 'Perempuan',
            ],
        ]);

        DB::table('karyawan')->insert([
            [
                'id_toko'  			=> 1,
                'id_jns_kelamin'  	=> 1,
                'nama_karyawan'  	=> 'Billy',
                'tempat_lhr'  		=> 'Palembang',
                'tgl_lhr'  			=> Carbon::createFromFormat('d/m/Y', '11/11/1975'),
                'alamat'  			=> 'jl. asd no 123',
                'nomor_telp'  		=> 089123456789,
            ],
            [
                'id_toko'  			=> 1,
                'id_jns_kelamin'  	=> 1,
                'nama_karyawan'  	=> 'John',
                'tempat_lhr'  		=> 'Jakarta',
                'tgl_lhr'  			=> Carbon::createFromFormat('d/m/Y', '9/9/1979'),
                'alamat'  			=> 'jl. def no 456',
                'nomor_telp'  		=> 089567891234,
            ],
            [
                'id_toko'  			=> 2,
                'id_jns_kelamin'  	=> 2,
                'nama_karyawan'  	=> 'Alice',
                'tempat_lhr'  		=> 'Medan',
                'tgl_lhr'  			=> Carbon::createFromFormat('d/m/Y', '11/11/1975'),
                'alamat'  			=> 'jl. ghi no 789',
                'nomor_telp'  		=> 089123945678,
            ],
        ]);

        DB::table('gaji_karyawan')->insert([
            [
                'id_karyawan'  		=> 1,
                'bonus'  			=> 250000,
                'gaji'  			=> 1450000,
                'denda'  			=> 125000,
                'uang_makan'  		=> 600000,
                'jumlah_gaji'  		=> 2175000,
            ],
            [
                'id_karyawan'  		=> 2,
                'bonus'  			=> 150000,
                'gaji'  			=> 450000,
                'denda'  			=> 25000,
                'uang_makan'  		=> 600000,
                'jumlah_gaji'  		=> 1750000,
            ],
            [
                'id_karyawan'  		=> 3,
                'bonus'  			=> 350000,
                'gaji'  			=> 2500000,
                'denda'  			=> 200000,
                'uang_makan'  		=> 60000,
                'jumlah_gaji'  		=> 3250000,
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
