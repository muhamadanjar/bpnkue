<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JaringanJalanStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jaringan_jalan_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_ruas');
            $table->string('nama');
            $table->string('lebar');
            $table->string('panjang_ruas');
            $table->string('nama_ruas');
            $table->string('no_ruas');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('titik_pangkal');
            $table->string('titik_akhir');
            $table->string('kelas');
            $table->string('fungsi');
            $table->string('jenis_perkerasan');
            $table->integer('tahun_renovasi');
            $table->string('kondisi');
            $table->string('sempadan');
            $table->string('drainase');
            $table->string('kondisi_drainase');
            $table->string('panjang');
            $table->string('keterangan');
            $table->text('shape_line');
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
        Schema::dropIfExists('jaringan_jalan_status');
    }
}
