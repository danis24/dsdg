<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('penduduk_id');
            $table->string('nama_pengajuan');
            $table->string('status');
            $table->timestamps();

            $table->foreign('penduduk_id')->references('id')->on('penduduk');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('riwayat');
        Schema::enableForeignKeyConstraints();
    }
}
