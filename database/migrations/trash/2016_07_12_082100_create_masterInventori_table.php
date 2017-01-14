<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterInventoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MasterInventori', function (Blueprint $table) {
            $table->unsignedInteger('idInventori')->primary();
            $table->unsignedInteger('idMerkBrg');
            $table->unsignedInteger('idTipeBrg');
            $table->string('namaBarang', 100);
            $table->integer('hargaBarang');
            $table->integer('jumlah');
        });

        Schema::create('MasterMerk', function (Blueprint $table) {
            $table->unsignedInteger('idMerk')->primary();
            $table->string('merk', 100);
        });

        Schema::create('MasterTipe', function (Blueprint $table) {
            $table->unsignedInteger('idTipe')->primary();
            $table->string('tipe', 100);
        });

        Schema::table('MasterInventori', function (Blueprint $table) {
            $table->foreign('idMerkBrg')
                ->references('idMerk')->on('MasterMerk')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('idTipeBrg')
                ->references('idTipe')->on('MasterTipe')
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
        Schema::drop('MasterInventori');
        Schema::drop('MasterMerk');
        Schema::drop('MasterTipe');
    }
}
