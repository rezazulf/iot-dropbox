<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tb_user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_user');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('level');
            $table->timestamps();
        });

         DB::table('tb_user')->insert([
            'nama_user' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'level' => 'admin',
        ]);

        DB::table('tb_user')->insert([
            'nama_user' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('petugas'),
            'level' => 'petugas',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_user');
    }
};