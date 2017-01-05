<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KuesionerBagianDua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_bagian_dua', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_kuesioner')->nullable();
            $table->string('nomor_bsn')->nullable();
            $table->string('nama_surveyor')->nullable();
            $table->date('tgl_survey')->nullable();
            $table->string('propinsi')->nullable();

            $table->string('ii.1')->nullable()->comment('');
            $table->string('ii.1.a')->nullable()->comment('');
            $table->string('ii.2')->nullable()->comment('');
            $table->string('ii.2.a')->nullable()->comment('');
            $table->string('ii.3')->nullable()->comment('');
            $table->string('ii.3.a')->nullable()->comment('');
            $table->string('ii.3.b')->nullable()->comment('');
            $table->string('ii.3.c')->nullable()->comment('');
            $table->string('ii.3.d')->nullable()->comment('');
            $table->string('ii.3.e')->nullable()->comment('');
            $table->string('ii.3.e.a')->nullable()->comment('');
            $table->string('ii.4')->nullable()->comment('');
            $table->string('ii.5')->nullable()->comment('');
            $table->string('ii.6')->nullable()->comment('');
            $table->string('ii.6.a')->nullable()->comment('');
            $table->string('ii.7.a')->nullable()->comment('');
            $table->string('ii.7.b')->nullable()->comment('');
            $table->string('ii.7.c')->nullable()->comment('');
            $table->string('ii.7.d')->nullable()->comment('');
            $table->string('ii.7.d.a')->nullable()->comment('');
            $table->string('ii.7.e.a')->nullable()->comment('');
            $table->string('ii.8')->nullable()->comment('');
            $table->string('ii.8.a')->nullable()->comment('');
            $table->string('ii.8.b')->nullable()->comment('');
            $table->string('ii.8.c')->nullable()->comment('');
            $table->string('ii.9')->nullable()->comment('');
            $table->string('ii.9.a')->nullable()->comment('');

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
        Schema::dropIfExists('kuesioner_bagian_dua');
    }
}
