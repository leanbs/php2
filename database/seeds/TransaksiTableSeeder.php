<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransaksiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        DB::table('jenis_transaksi')->delete();
        DB::table('detil_transaksi')->delete();
        DB::table('transaksi')->delete();

        DB::table('jenis_transaksi')->insert([
            [
                'jenis_transaksi'  	=> 'Penjualan',
            ],
            [
                'jenis_transaksi'  	=> 'Pembelian',
            ],
        ]);

        DB::table('detil_transaksi')->insert([
            [
                'id_detil_transaksi'  	=>	51203,
                'tipe_barang'			=>	'ABC-123',
                'nama_pelanggan'		=>	'John Doe',
                'jumlah'				=>	3,
                'harga_total'			=>	2250000,
                'tanggal_transaksi'		=>	Carbon::createFromFormat('d/m/Y', '11/11/2016'),
                'keterangan'			=>	"Minta Bracket",
            ],
            [
                'id_detil_transaksi'  	=>	51204,
                'tipe_barang'			=>	'DEF-456',
                'nama_pelanggan'		=>	'Stevens John',
                'jumlah'				=>	1,
                'harga_total'			=>	16750000,
                'tanggal_transaksi'		=>	Carbon::createFromFormat('d/m/Y', '11/12/2016'),
                'keterangan'			=>	"Minta Bracket + Kabel ext 23M",
            ],          
        ]);

        DB::table('transaksi')->insert([
            [
                'id_jenis_transaksi'  	=>	1,
                'id_detil_transaksi'	=>	1,
                'id_karyawan'			=>	2,
                'keterangan'			=>	"",
            ],
            [
                'id_jenis_transaksi'  	=>	1,
                'id_detil_transaksi'	=>	2,
                'id_karyawan'			=>	3,
                'keterangan'			=>	"Barang agak penyok",
            ],          
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
