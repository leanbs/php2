<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MasterToko', function (Blueprint $table) {
            $table->unsignedInteger('idToko')->primary();
            $table->string('namaToko', 100);
        });

        Schema::create('MasterKaryawan', function (Blueprint $table) {
            $table->unsignedInteger('idKaryawan')->primary();
            $table->unsignedInteger('idToko');
            $table->string('namaKaryawan', 100);
            $table->string('alamat', 100);
            $table->string('noTelp', 20);
        });

        Schema::create('HutangKaryawan', function (Blueprint $table) {
            $table->unsignedInteger('idHutang')->primary();
            $table->unsignedInteger('idKaryawan');
            $table->unsignedInteger('hutang');
            $table->datetime('jangkaWaktu');
            $table->integer('status');
        });

        Schema::create('GajiKaryawan', function (Blueprint $table) {
            $table->unsignedInteger('idKaryawan');
            $table->integer('bonus');
            $table->unsignedInteger('gaji');
        });

        Schema::table('MasterKaryawan', function (Blueprint $table) {
            $table->foreign('idToko')
                ->references('idToko')->on('MasterToko')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('GajiKaryawan', function (Blueprint $table) {
            $table->foreign('idKaryawan')
                ->references('idKaryawan')->on('MasterKaryawan')
                ->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('HutangKaryawan', function (Blueprint $table) {
            $table->foreign('idKaryawan')
                ->references('idKaryawan')->on('MasterKaryawan')
                ->onDelete('restrict')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('MasterToko');
        Schema::drop('MasterKaryawan');
        Schema::drop('GajiKaryawan');
        Schema::drop('HutangKaryawan');
 
    }
}
