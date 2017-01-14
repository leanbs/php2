<?php

use Illuminate\Database\Seeder;

class masterInventori_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('MasterInventori')->delete();

        DB::table('MasterMerk')->delete();

        DB::table('MasterTipe')->delete();

        DB::table('MasterMerk')->insert([
            [
                'idMerk'   	=> 3101,
                'merk'  	=> 'Samsung',
            ],
            [
                'idMerk'   	=> 3102,
                'merk'  	=> 'Toshiba',
            ],
            [
                'idMerk'   	=> 3103,
                'merk'  	=> 'Panasonic',
            ],
        ]);

        DB::table('MasterTipe')->insert([
            [
                'idTipe'   	=> 3201,
                'tipe'  	=> 'Televisi',
            ],
            [
                'idTipe'   	=> 3202,
                'tipe'  	=> 'Kipas Angin',
            ],
            [
                'idTipe'   	=> 3203,
                'tipe'  	=> 'Mesin Cuci',
            ],
        ]);

        DB::table('MasterInventori')->insert([
            [
                'idInventori'   => 3001,
                'idMerkBrg'  	=> 3101,
                'idTipeBrg'  	=> 3201,
                'namaBarang' 	=> 'AX-7271',
                'hargaBarang' 	=> 1250000,
                'jumlah' 		=> 52,
            ],
            [
                'idInventori'   => 3002,
                'idMerkBrg'  	=> 3102,
                'idTipeBrg'  	=> 3201,
                'namaBarang' 	=> 'BX-9271',
                'hargaBarang' 	=> 1780000,
                'jumlah' 		=> 52,
            ],
            [
                'idInventori'   => 3003,
                'idMerkBrg'  	=> 3101,
                'idTipeBrg'  	=> 3202,
                'namaBarang' 	=> 'CX-2271',
                'hargaBarang' 	=> 3250000,
                'jumlah' 		=> 52,
            ],
        ]);

    }
}
