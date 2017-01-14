<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_merk', function (Blueprint $table) {
            $table->increments('id_merk');
            $table->string('merk', 20);
        });

        Schema::create('master_kategori', function (Blueprint $table) {
            $table->increments('id_kategori');
            $table->string('kategori', 20);
        });

        Schema::create('inventori', function (Blueprint $table) {
            $table->string('tipe_brg', 50)->primary();
            $table->unsignedInteger('id_merk');
            $table->unsignedInteger('id_kategori');
            $table->integer('harga_barang');
            $table->integer('jumlah');
        });

        Schema::table('inventori', function (Blueprint $table) {
            $table->foreign('id_merk')
                ->references('id_merk')->on('master_merk')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('id_kategori')
                ->references('id_kategori')->on('master_kategori')
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
        Schema::drop('master_merk');
        Schema::drop('master_kategori');
        Schema::drop('inventori');
    }
}
