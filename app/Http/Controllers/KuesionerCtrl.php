<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KuesionerCtrl extends Controller{
   	public function getIndex($value=''){
   		$kuesioner_satu =  \DB::table('kuesioner_bagian_satu')->get();
   		$kuesioner_dua =  \DB::table('kuesioner_bagian_dua')->get();
   		$kuesioner_tiga =  \DB::table('kuesioner_bagian_tiga')->get();
   		return view('kuesioner')->with('kuesioner_satu',$kuesioner_satu)->with('kuesioner_dua',$kuesioner_dua)->with('kuesioner_tiga',$kuesioner_tiga);
   	}

   	public function getGambaranUmum(){
   		$i_7 = $this->getBagianSatuJmlKaryawan();
   		$json_i_7 = ($i_7);
   		$i_9 = $this->getMempunyaiLegalitasUsaha();
   		$json_i_9 = ($i_9);
   		$i_10 = $this->getLegalitasYangDimiliki();
   		$json_i_10 = ($i_10);
   		$i_12 = $this->getMempunyaiMerkTerdaftar();
   		$json_i_12 = ($i_12);
   		$i_13 = $this->getSudahMempunyaiIjinEdar();
   		$json_i_13 = ($i_13);
   		$pangan = $this->getProdukYangDihasilkan();
   		$json_pangan = ($pangan);

         //Bagian 3
         $iii_1 = $this->getMendapatkanSNI();
         $json_iii_1 = ($iii_1);
         

   		
   		
   		return view('gambaranumum')
   		->with('i7',$json_i_7)
   		->with('i9',$json_i_9)
   		->with('i10',$json_i_10)
   		->with('i12',$json_i_12)
   		->with('i13',$json_i_13)
   		->with('pangan',$json_pangan)
         ->with('iii_1',$json_iii_1);
   	}

   	//Bagian 1

   	public function getBagianSatuJmlKaryawan($value=''){
   		$bagiansatu_jumlahkaryawan = 'Jumlah karyawan';
   		$i7 = array();
   		$i7_1_4 = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_7')
   			->where('i_7', '>=', 1)
   			->where('i_7', '<=', 4)
   			->count();
   		$i7_5_19 = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_7')
   			->where('i_7', '>=', 5)
   			->where('i_7', '<=', 19)
   			->count();
   		$i7_20_99 = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_7')
   			->where('i_7', '>=', 20)
   			->where('i_7', '<=', 99)
   			->count();
   		$i7_lebih_100 = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_7')
   			->where('i_7', '>=', 100)
   			->count();

   		$i7_total = ($i7_1_4+$i7_5_19+$i7_20_99+$i7_lebih_100);
   		$i7_array = array($i7_1_4,$i7_5_19,$i7_20_99,$i7_lebih_100);
         $tambah=array();
   		for ($i=0; $i < 4; $i++) { 
   			$i7['hasil'][$i]['frekuensi'] = $i7_array[$i];
   			$i7['hasil'][$i]['presentase'] = number_format(($i7_array[$i]/$i7_total)*100,2);
            array_push($tambah, number_format(($i7_array[$i]/$i7_total)*100,2)) ;
   		}
         $i7['data'] = $tambah;

   		return $i7;
   	}

   	public function getMempunyaiLegalitasUsaha($value=''){
   		$judul = 'Apakah UMKM sudah mempunyai legalitas usaha';

   		$i9 = array();
   		$i9_belum = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_9')
   			->where('i_9',0)
   			->count();
   		$i9_sudah = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_9')
   			->where('i_9', 1)
   			->count();
   
   		$i9_total = ($i9_belum+$i9_sudah);
   		$i9_array = array($i9_belum,$i9_sudah);
         $info = array('Sudah','Belum');
         $tambah =array();
   		for ($i=0; $i < 2; $i++) { 
   			$i9['hasil'][$i]['frekuensi'] = $i9_array[$i];
   			$i9['hasil'][$i]['presentase'] = number_format(($i9_array[$i]/$i9_total)*100,2);
            
            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($i9_array[$i]/$i9_total)*100,2);
   		}
         $i9['data'] = $tambah;
   		return $i9;

   	}

   	public function getLegalitasYangDimiliki($value=''){
   		$judul = 'Legalitas yang Dimiliki';

   		$i10 = array();
   		$i10_tdp = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_10')
   			->where('i_10',1)
   			->count();
   		$i10_iui = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_10')
   			->where('i_10', 2)
   			->count();
   		$i10_lainnya = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_10')
   			->where('i_10', 3)
   			->count();
   
   		$i10_total = ($i10_tdp+$i10_iui+$i10_lainnya);
   		$i10_array = array($i10_tdp,$i10_iui,$i10_lainnya);
         $tambah=array();
   		for ($i=0; $i < count($i10_array); $i++) { 
   			$i10['hasil'][$i]['frekuensi'] = $i10_array[$i];
   			$i10['hasil'][$i]['presentase'] = number_format(($i10_array[$i]/$i10_total)*100,2);
            array_push($tambah, number_format(($i10_array[$i]/$i10_total)*100,2)) ;
   		}
         $i10['data'] = $tambah;

   		return $i10;

   	}

   	public function getMempunyaiMerkTerdaftar($value=''){
   		$judul = 'Apakah Produk yang dihasilkan sudah mempunyai Merk yang terdaftar di Kementerian Hukum dan HAM';

   		$i12 = array();
   		$i12_belum = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_12')
   			->where('i_12',0)
   			->count();
   		$i12_sudah = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_12')
   			->where('i_12', 1)
   			->count();
   		
   
   		$i12_total = ($i12_belum+$i12_sudah);
   		$i12_array = array($i12_belum,$i12_sudah);
   		for ($i=0; $i < count($i12_array); $i++) { 
   			$i12[$i]['frekuensi'] = $i12_array[$i];
   			$i12[$i]['presentase'] = number_format(($i12_array[$i]/$i12_total)*100,2);
   		}

   		return $i12;

   	}

   	public function getSudahMempunyaiIjinEdar($value=''){
   		$judul = 'Apabila produk Saudara sudah mempunyai ijin edar?';

   		$i13 = array();
   		$i13_belum = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_13')
   			->where('i_13',0)
   			->count();
   		$i13_sudah = \DB::table('kuesioner_bagian_satu_repos')
   			->select('i_13')
   			->where('i_13', 1)
   			->count();
   		
   
   		$i13_total = ($i13_belum+$i13_sudah);
   		$i13_array = array($i13_belum,$i13_sudah);
   		for ($i=0; $i < count($i13_array); $i++) { 
   			$i13[$i]['frekuensi'] = $i13_array[$i];
   			$i13[$i]['presentase'] = number_format(($i13_array[$i]/$i13_total)*100,2);
   		}

   		return $i13;
   	}

   	public function getProdukYangDihasilkan(){
   		$judul = 'Jenis produk apa yang saudara hasilkan?';

   		$pangan = array();
   		$pangan_p = \DB::table('kuesioner_bagian_satu_repos')
   			->select('jenis_umk')
   			->where('jenis_umk','P')
   			->count();
   		$pangan_n = \DB::table('kuesioner_bagian_satu_repos')
   			->select('jenis_umk')
   			->where('jenis_umk', 'N')
   			->count();
   		
   
   		$pangan_total = ($pangan_p+$pangan_n);
   		$pangan_array = array($pangan_p,$pangan_n);
   		for ($i=0; $i < count($pangan_array); $i++) { 
   			$pangan[$i]['frekuensi'] = $pangan_array[$i];
   			$pangan[$i]['presentase'] = number_format(($pangan_array[$i]/$pangan_total)*100,2);
   		}

   		return $pangan;

   	}


   	//Bagian 3

   	public function getMendapatkanSNI($value=''){
   		$judul = 'Apakah Saudara sudah pernah mendapatkan informasi mengenai Standar Nasional Indonesia (SNI)?';

         $iii_1 = array();
         $iii_1_belum = \DB::table('kuesioner_bagian_tiga')
            ->select('iii_1')
            ->where('iii_1',0)
            ->count();
         $iii_1_sudah = \DB::table('kuesioner_bagian_tiga')
            ->select('iii_1')
            ->where('iii_1', 1)
            ->count();
         
   
         $iii_1_total = ($iii_1_belum+$iii_1_sudah);

         $iii_1_array = array($iii_1_belum,$iii_1_sudah);
         for ($i=0; $i < count($iii_1_array); $i++) { 
            $iii_1[$i]['frekuensi'] = $iii_1_array[$i];
            $iii_1[$i]['presentase'] = number_format(($iii_1_array[$i]/$iii_1_total)*100,2);
         }

         return $iii_1;
   	}
}
