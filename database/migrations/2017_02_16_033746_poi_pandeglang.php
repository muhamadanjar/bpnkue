<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PoiPandeglang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('poi_pandeglang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('daerah_irigasi',60);
            $table->string('bendung',60)->nullable();
            $table->string('jaringan_irigasi',60)->nullable();
            $table->string('jaringan_irigasi_bangunan',60)->nullable();
            $table->string('saluran_primer',60)->nullable();
            $table->string('drain_inlet',60)->nullable();
            $table->string('saluran_sekunder',60)->nullable();
            $table->string('kondisi')->nullable();
            $table->string('foto')->nullable();
            $table->float('x')->nullable();
            $table->float('y')->nullable();
            $table->timestamps();
        });
        DB::statement("SELECT AddGeometryColumn('poi_pandeglang', 'the_geom', 4326, 'POINT', 2 )");
        //SELECT AddGeometryColumn('test_geom', 'the_geom',4326, 'POINT', 'XY');
    }


    public function down(){
        Schema::dropIfExists('poi_pandeglang');
    }
}
