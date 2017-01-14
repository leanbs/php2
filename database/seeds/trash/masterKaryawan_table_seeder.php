<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class masterKaryawan_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('MasterToko')->delete();
        DB::table('MasterKaryawan')->delete();
        DB::table('HutangKaryawan')->delete();
        DB::table('GajiKaryawan')->delete();

        DB::table('MasterToko')->insert([
            [
                'idToko'    => 4001,
                'namaToko'  => 'Toko1',
            ],
            [
                'idToko'    => 4002,
                'namaToko'  => 'Toko2',
            ],
            [
                'idToko'    => 4003,
                'namaToko'  => 'Toko3',
            ],
        ]);

        DB::table('MasterKaryawan')->insert([
            [
                'idKaryawan'   	=> 3001,
                'idToko'  		=> 4001,
                'namaKaryawan' 	=> 'Asep',
                'alamat' 		=> 'Jalan Lorem',
                'notelp' 		=> '0819-123123123',
            ],
            [
                'idKaryawan'   	=> 3002,
                'idToko'  		=> 4002,
                'namaKaryawan' 	=> 'Alice',
                'alamat' 		=> 'Jalan Ipsum',
                'notelp' 		=> '0819-123123456',
            ],
            [
                'idKaryawan'   	=> 3003,
                'idToko'  		=> 4003,
                'namaKaryawan' 	=> 'Bob',
                'alamat' 		=> 'Jalan Dolor',
                'notelp' 		=> '0819-123456123',
            ],
        ]);

         DB::table('HutangKaryawan')->insert([
            [
                'idHutang'   	=> 4101,
                'idKaryawan'  	=> 3001,
                'hutang' 		=> 200000,
                'jangkaWaktu' 	=> Carbon::createFromFormat('d/m/Y', '8/9/2016'),
                'status' 		=> 1,
            ],
            [
                'idHutang'   	=> 4102,
                'idKaryawan'  	=> 3002,
                'hutang' 		=> 450000,
                'jangkaWaktu'   => Carbon::createFromFormat('d/m/Y', '8/9/2016'),
                'status' 		=> 0,
            ],
            [
                'idHutang'   	=> 4103,
                'idKaryawan'  	=> 3003,
                'hutang' 		=> 725000,
                'jangkaWaktu'   => Carbon::createFromFormat('d/m/Y', '8/9/2016'),
                'status' 		=> 0,
            ],
        ]);
    }
}
