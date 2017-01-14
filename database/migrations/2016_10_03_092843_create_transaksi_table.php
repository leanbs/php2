<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_transaksi', function (Blueprint $table) {
            $table->increments('id_jenis_transaksi');
            $table->string('jenis_transaksi', 20);
        });

        Schema::create('detil_transaksi', function (Blueprint $table) {
            $table->unsignedInteger('id_transaksi', 50);
            $table->string('tipe_barang', 50);
            $table->integer('jumlah');
            $table->integer('harga');
            $table->string('keterangan', 255);
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->unsignedInteger('id_transaksi')->primary(); //no nota
            $table->unsignedInteger('id_jenis_transaksi'); //jual atau beli
            $table->string('nama_pelanggan',50);
            $table->string('alamat');
            $table->string('nomor_telp', 20);
            $table->dateTime('tanggal_transaksi');
            $table->unsignedInteger('id_karyawan');
            $table->boolean('status_bayar');
            $table->boolean('status_kirim');
        });

        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreign('id_jenis_transaksi')
                ->references('id_jenis_transaksi')->on('jenis_transaksi')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('id_karyawan')
                ->references('id_karyawan')->on('karyawan')
                ->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('detil_transaksi', function (Blueprint $table) {
            $table->foreign('tipe_barang')
                ->references('tipe_brg')->on('inventori')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('id_transaksi')
                ->references('id_transaksi')->on('transaksi')
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
        Schema::drop('jenis_transaksi');
        Schema::drop('detil_transaksi');
        Schema::drop('transaksi');
    }
}
