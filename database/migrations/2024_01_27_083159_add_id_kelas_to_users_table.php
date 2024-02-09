<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom foreign key id_kelas
            $table->unsignedBigInteger('id_kelas')->nullable();

            // Menetapkan foreign key ke kolom id pada tabel kelas
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');;

            // Menambahkan indeks ke kolom foreign key untuk performa
            $table->index('id_kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
