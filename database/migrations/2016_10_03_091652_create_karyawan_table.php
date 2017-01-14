<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_toko', function (Blueprint $table) {
            $table->increments('id_toko');
            $table->string('nama_toko', 20);
            $table->string('alamat', 255);
            $table->unsignedInteger('supervisor', 20);
        });

        Schema::create('jns_kelamin', function (Blueprint $table) {
            $table->increments('id_jns_kelamin');
            $table->string('jns_kelamin', 20);
        });

        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('id_karyawan');
            $table->unsignedInteger('id_toko');
            $table->unsignedInteger('id_jns_kelamin');
            $table->string('nama_karyawan', 50);
            $table->string('tempat_lhr', 15);
            $table->date('tgl_lhr');
            $table->string('alamat', 255);
            $table->string('nomor_telp', 20);
        });

        Schema::create('gaji_karyawan', function (Blueprint $table) {
            $table->unsignedInteger('id_karyawan');
            $table->integer('bonus');
            $table->integer('gaji');
            $table->integer('denda');
            $table->integer('uang_makan');
            $table->integer('jumlah_gaji');
        });

        Schema::create('hutang_karyawan', function (Blueprint $table) {
            $table->increments('id_hutang');
            $table->unsignedInteger('id_karyawan');
            $table->integer('hutang');
            $table->date('jangka_waktu');
            $table->string('status', 25);
        });

        Schema::create('presensi_karyawan', function (Blueprint $table) {
            $table->unsignedInteger('id_karyawan');
            $table->boolean('presensi');
            $table->dateTime('tgl_presensi');
        });

        Schema::table('karyawan', function (Blueprint $table) {
            $table->foreign('id_toko')
                ->references('id_toko')->on('master_toko')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('id_jns_kelamin')
                ->references('id_jns_kelamin')->on('jns_kelamin')
                ->onDelete('restrict')->onUpdate('cascade');
        });

         Schema::table('master_toko', function (Blueprint $table) {
            $table->foreign('supervisor')
                ->references('id_karyawan')->on('karyawan')
                ->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('gaji_karyawan', function (Blueprint $table) {
            $table->foreign('id_karyawan')
                ->references('id_karyawan')->on('karyawan')
                ->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('hutang_karyawan', function (Blueprint $table) {
            $table->foreign('id_karyawan')
                ->references('id_karyawan')->on('karyawan')
                ->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('presensi_karyawan', function (Blueprint $table) {
            $table->foreign('id_karyawan')
                ->references('id_karyawan')->on('karyawan')
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
        Schema::drop('master_toko');
        Schema::drop('jns_kelamin');
        Schema::drop('karyawan');
        Schema::drop('gaji_karyawan');
        Schema::drop('hutang_karyawan');
        Schema::drop('presensi_karyawan');
    }
}
