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
            $table->string('no_ruas');
            $table->string('kode_ruas');
            $table->string('nama_ruas');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('titik_pangkal')->nullable();
            $table->string('titik_akhir')->nullable();
            $table->string('lebar_ruas');
            $table->string('panjang_ruas');
            $table->string('jenis_perkerasan');
            $table->integer('tahun_renovasi');
            $table->string('id_kondisi');
            $table->string('jenis_permukaan_jalan')->nullable();

            $table->string('kondisi_lapang')->nullable();
            $table->string('nilai_rci')->nullable();

            $table->string('kelas')->nullable();
            $table->string('fungsi');
            $table->string('keterangan');
            $table->string('sempadan');
            $table->string('kondisi_sempadan');
            $table->string('drainase');
            $table->string('kondisi_drainase');
            $table->text('shape_line')->nullable();
            $table->timestamps();
        });

        DB::statement("SELECT AddGeometryColumn('jaringan_jalan_status', 'the_geom', 4326, 'LINESTRING',2)");
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
