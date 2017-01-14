<?php

use Illuminate\Database\Seeder;

class InventoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        DB::table('master_merk')->delete();
        DB::table('master_kategori')->delete();
        DB::table('inventori')->delete();

        DB::table('master_merk')->insert([
            [
                'merk'  	=> 'Samsung',
            ],
            [
                'merk'  	=> 'Toshiba',
            ],
            [
                'merk'  	=> 'Panasonic',
            ],
        ]);

        DB::table('master_kategori')->insert([
            [
                'kategori'  	=> 'Televisi',
            ],
            [
                'kategori'  	=> 'AC',
            ],
            [
                'kategori'  	=> 'Mesin Cuci',
            ],
        ]);

        DB::table('inventori')->insert([
            [
                'tipe_brg'  	=>	'ABC-123',
                'id_merk'		=>	1,
                'id_kategori'	=>	1,
                'harga_barang'	=>	1500000,
                'jumlah'		=>	20,
            ],
            [
                'tipe_brg'  	=>	'DEF-456',
                'id_merk'		=>	1,
                'id_kategori'	=>	2,
                'harga_barang'	=>	1500000,
                'jumlah'		=>	20,
            ],
            [
                'tipe_brg'  	=>	'GHI-789',
                'id_merk'		=>	2,
                'id_kategori'	=>	3,
                'harga_barang'	=>	1500000,
                'jumlah'		=>	20,
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
