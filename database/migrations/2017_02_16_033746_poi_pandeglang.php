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
            $table->string('name',60);
            $table->string('foto');
            $table->float('x');
            $table->float('y');
            $table->timestamps();
        });
        DB::statement("SELECT AddGeometryColumn('poi_pandeglang', 'the_geom', 4326, 'POINT', 2 )");
        //SELECT AddGeometryColumn('test_geom', 'the_geom',4326, 'POINT', 'XY');
    }


    public function down(){
        Schema::dropIfExists('poi_pandeglang');
    }
}
