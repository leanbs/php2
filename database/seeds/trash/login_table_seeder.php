<?php

use Illuminate\Database\Seeder;

class login_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Login')->delete();

        DB::table('Login')->insert([
            [
                'Id'        => 101,
                'Username'  => 'root',
                'Password'  => bcrypt('root'),
                'RoleCode'  => 'ADMIN',
            ],
            [
                'Id'        => 201,
                'Username'  => 'piki',
                'Password'  => bcrypt('piki'),
                'RoleCode'  => 'USER',
            ],
            [
                'Id'        => 202,
                'Username'  => 'pika',
                'Password'  => bcrypt('pika'),
                'RoleCode'  => 'USER',
            ],
        ]);
    }
}
