<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('JenisTransaksi', function (Blueprint $table) {
            $table->unsignedInteger('idJenis')->primary();
            $table->string('jenisTransaksi', 100);
        });

        Schema::create('MasterTransaksi', function (Blueprint $table) {
            $table->unsignedInteger('idTransaksi')->primary();
            $table->unsignedInteger('idJenis');
            $table->datetime('tanggalTransaksi');
            $table->string('Keterangan', 100);
        });


        Schema::create('DetilTransaksi', function (Blueprint $table) {
            $table->unsignedInteger('idDetilTransaksi')->primary();
            $table->unsignedInteger('idInventori');
            $table->unsignedInteger('idTransaksi');
            $table->integer('jumlah');
            $table->string('Keterangan', 100);
        });

        Schema::table('MasterTransaksi', function (Blueprint $table) {
            $table->foreign('idJenis')
                ->references('idJenis')->on('JenisTransaksi')
                ->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('DetilTransaksi', function (Blueprint $table) {
            $table->foreign('idTransaksi')
                ->references('idTransaksi')->on('MasterTransaksi')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('idInventori')
                ->references('idInventori')->on('MasterInventori')
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
        Schema::drop('MasterTransaksi');
        Schema::drop('JenisTransaksi');
        Schema::drop('DetilTransaksi');
    }
}
