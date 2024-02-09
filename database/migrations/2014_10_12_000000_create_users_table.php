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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['guru', 'siswa', 'admin']); // Sesuaikan dengan enum yang sesuai
            $table->string('nama');
            $table->string('username');
            $table->string('nomor_induk');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('password');
            $table->text('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
