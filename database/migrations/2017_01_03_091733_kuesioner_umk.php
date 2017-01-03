<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KuesionerUmk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_umk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_umk');
            $table->string('nama_pemilik');
            $table->text('alamat_perusahaan');
            $table->string('nohp_telp');
            $table->string('email');
            $table->string('alamat_website');
            $table->string('jumlah_karyawan',10);
            $table->string('pembagian_pekerjaan',10);
            $table->string('umkm_legalitas',10);
            $table->string('legalitas_dimiliki',10);
            $table->string('legalitas_dimiliki_ket')->nullable();
            $table->string('produk_utama_umkm');
            $table->string('produk_utama_umkm_merk_terdaftar_kememhuk_ham',10);
            $table->string('produk_utama_umkm_merk_terdaftar_kememhuk_ham_noreg')->nullable();
            $table->string('ijin_edar',10);
            $table->string('ijin_edar_berupa')->nullable();
            $table->string('rata_volume_produk_pertahun');
            $table->string('rata_nilai_produk_pertahun');
            $table->string('area_pemasaran_produk')->comment('Pemasaran untuk Produk');

            //Tingkat Implementasi SNI

            $table->string('pembeli_mensyaratkan_standar_produk',10)->comment('Pemasaran untuk Produk');
            $table->string('pembeli_mensyaratkan_standar_produk_ket')->nullable()
                ->comment('Pemasaran untuk Produk');
            $table->string('umkm_menerapkan_standar_produk',10)->comment('Pemasaran untuk Produk');
            $table->string('umkm_menerapkan_standar_produk_ket')->nullable()
                ->comment('Pemasaran untuk Produk');
            $table->string('umkm_menerapkan_sistem_mutu',10)->comment('Pemasaran untuk Produk');
            $table->string('umkm_menerapkan_sistem_mutu_ket')->nullable()
                ->comment('Pemasaran untuk Produk');
            $table->string('umkm_mempunyai_prosedur_proses_produksi',10)->comment('Pemasaran untuk Produk');
            $table->string('diagram_alur_proses_produksi')->nullable();
            $table->string('produk_pengujian',10)->comment('Produk yang dihasilkan pernah dilakukan pengujian di lab');
            $table->string('produk_pengujian_ket')->nullable()
                ->comment('Produk yang dihasilkan pernah dilakukan pengujian di lab keterangan');
            $table->string('sertifikasi_dimiliki',60);
            $table->string('sertifikasi_dimiliki_tahun_penerbitan',10)->nullable();
            $table->string('sertifikasi_dimiliki_lembaga_pernerbit',10)->nullable();
            $table->string('umkm_mendapat_bimbingan_sni',10);
            $table->string('umkm_mendapat_bimbingan_sni_tahun')->nullable();
            $table->string('umkm_mendapat_bimbingan_sni_instansi')->nullable();
            $table->string('umkm_mendapat_bimbingan_sni_bentuk_bimbingan')->nullable();
            $table->string('bimbingan_memberikan_manfaat',10)->nullable();
            $table->string('bimbingan_memberikan_manfaat_ket')->nullable();

            //Kendala Penerapan SNI

            $table->string('mendapatkan_info_sni',10);
            $table->string('mendapatkan_info_sni_dari',10)->nullable();
            $table->string('mendapatkan_info_sni_dari_ket')->nullable();

            $table->string('pemahaman_sni',10);
            $table->string('mendapatkan_dokumen_sni',10);
            $table->string('mendapatkan_dokumen_sni_dari',10)->nullable();
            $table->string('mendapatkan_dokumen_sni_dari_ket')->nullable();

            $table->string('harga_dokumen_sni',10);
            $table->string('sni_mudah_diterapkan_umkm',10);
            $table->string('kendala_penerapan_sni',10);
            $table->string('kendala_penerapan_sni_ket')->nullable();

            $table->string('sudah_mengajukan_sertifikasi_sni',10);
            $table->string('sudah_mengajukan_sertifikasi_ket')->nullable();
            $table->string('kendala_mengajukan_sertifikasi',10);
            $table->string('kendala_mengajukan_sertifikasi')->nullable();

            $table->string('nilai_tambah_mendapatkan_sertifikasi',10);
            $table->string('nilai_tambah_mendapatkan_sertifikasi')->nullable();

            $table->string('masukan_bsn');

            $table->string('no_bsn');
            $table->string('diisi_oleh_nama');
            $table->string('diisi_oleh_tgl');
            $table->string('diisi_oleh_provinsi');
            
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
        Schema::dropIfExists('kuesioner_umk');
    }
}
