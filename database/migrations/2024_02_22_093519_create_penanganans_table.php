<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenanganansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penanganans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('siswa_id');
            $table->bigInteger('user_id');
            $table->date('tanggal');
            $table->text('permasalahan');
            $table->text('tindak_lanjut');
            $table->text('hasil');
            $table->text('pihak_terlibat');
            $table->string('dokumentasi')->nullable();
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
        Schema::dropIfExists('penanganans');
    }
}
