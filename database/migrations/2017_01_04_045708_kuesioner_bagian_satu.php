<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KuesionerBagianSatu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_bagian_satu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_input');
            $table->string('nomor_kuesioner');
            $table->string('nomor_bsn');
            $table->string('nama_surveyor');
            $table->date('tgl_survey');
            $table->string('propinsi');
            $table->string('i_1')->comment('Nama UMKM');
            $table->string('i_2')->comment('Nama Pemilik');
            $table->string('i_3')->comment('Alamat Perusahaan');
            $table->string('i_4')->comment('No HP/Telepon');
            $table->string('i_5')->comment('Alamat E-mail');
            $table->string('i_6')->comment('Alamat Website');
            $table->string('i_7')->comment('Jumlah Karyawan');
            $table->string('i_8')->comment('Dalam melakukan proses usahanya, sudah dilakukan pembagian pekerjaan untuk masing-masing karyawan (Seperti bagian administrasi, produksi, pemasaran, dll) ');
            $table->string('i_9')->comment('Apakah UMKM sudah mempunyai legalitas usaha');
            $table->string('i_10')->comment('Apabila jabawan butir b sudah, legalitas yang dimiliki berupa');
            $table->string('i_10_a')->comment('Nomor Registrasi TDP/IUI/Lainnya');
            $table->string('i_10_b')->comment('Lampiran Copy TDP/IUI/Lainnya');
            $table->string('i_11')->comment('Sebutkan produk yang dihasilkan oleh UMKM Saudara, dan sebutkan mana yang merupakan produk utama? ');
            $table->string('i_11_a')->comment('Lampiran foto Produk');
            $table->string('i_12')->comment('Apakah Produk yang dihasilkan sudah mempunyai Merkyang terdaftar di Kementerian Hukum dan HAM');
            $table->string('i_12_a')->comment('Nomor Registrasi Merk');
            $table->string('i_13')->comment('Apabila produk Saudara sudah mempunyai ijin edar?');
            $table->string('i_13_a')->comment('Keterangan lain jika sudah mempunyai ijin edar');
            $table->string('i_14')->comment('Berapakah rata-rata pertahun volume produksi untuk produk utama yang Saudara');
            $table->string('i_15')->comment('Berapakah rata-rata pertahun nilai produksi untuk produk utama yang Saudara hasilkan:');
            $table->string('i_16')->comment('Mohon disebutkan area pemasaran untuk produk Saudara:');
            $table->string('jenis_umk');
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
        Schema::dropIfExists('kuesioner_bagian_satu');
    }
}
