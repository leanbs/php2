<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Login', function (Blueprint $table) {
            $table->unsignedInteger('Id')->primary();
            $table->string('Username', 255)->unique();
            $table->string('Password', 60);
            $table->string('RememberToken', 100);
            $table->string('RoleCode', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Login');
    }
}
