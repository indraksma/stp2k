<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKodePelanggaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kode_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pelanggaran');
            $table->string('nama_pelanggaran');
            $table->bigInteger('jenis_pelanggaran_id');
            $table->integer('poin');
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
        Schema::dropIfExists('kode_pelanggarans');
    }
}
