<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JaringanJalanFungsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jaringan_jalan_fungsi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_ruas');
            $table->string('nama');
            $table->string('panjang');
            $table->string('lebar');
            $table->string('status');
            $table->string('keterangan');
            $table->text('shape_line')->nullable();
            $table->timestamps();
        });
        DB::statement("SELECT AddGeometryColumn('jaringan_jalan_fungsi', 'the_geom', 4326, 'LINESTRING',2)");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jaringan_jalan_fungsi');
    }
}
