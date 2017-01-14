<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class masterTransaksi_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('JenisTransaksi')->delete();

        DB::table('MasterTransaksi')->delete();

        DB::table('DetilTransaksi')->delete();

        DB::table('JenisTransaksi')->insert([
            [
                'idJenis'   		=> 5001,
                'JenisTransaksi'  	=> 'Penjualan',
            ],
            [
                'idJenis'   		=> 5002,
                'JenisTransaksi'  	=> 'Pembelian',
            ],            
        ]);

        DB::table('MasterTransaksi')->insert([
            [
                'idTransaksi'   	=> 5101,
                'idJenis'  			=> 5001,
                'tanggalTransaksi' 	=> Carbon::createFromFormat('d/m/Y', '18/7/2016'),
                'keterangan' 		=> 'lcd 2 biji',
            ],
            [
                'idTransaksi'   	=> 5102,
                'idJenis'  			=> 5001,
                'tanggalTransaksi'     => Carbon::createFromFormat('d/m/Y', '18/7/2016'),
                'keterangan' 		=> 'lcd 3 biji',
            ],
            [
                'idTransaksi'   	=> 5103,
                'idJenis'  			=> 5002,
                'tanggalTransaksi'  => Carbon::createFromFormat('d/m/Y', '18/7/2016'),
                'keterangan' 		=> 'lcd 4 biji',
            ],
        ]);

        DB::table('DetilTransaksi')->insert([
            [
                'idDetilTransaksi'  => 5301,
                'idInventori'  		=> 3001,
                'idTransaksi' 		=> 5101,
                'jumlah' 			=> 22,
                'keterangan' 		=> 'gpp',
            ],
            [
                'idDetilTransaksi'  => 5302,
                'idInventori'  		=> 3001,
                'idTransaksi' 		=> 5101,
                'jumlah' 			=> 22,
                'keterangan' 		=> 'gpp',
            ],
            [
                'idDetilTransaksi'  => 5303,
                'idInventori'  		=> 3001,
                'idTransaksi' 		=> 5101,
                'jumlah' 			=> 22,
                'keterangan' 		=> 'gpp',
            ],
        ]);
    }
}
