<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JalanStatus;
use DB;
class JalanStatusCtrl extends Controller{
    public function __construct($value=''){
      $this->middleware('auth');
    }

    public function getIndex($value=''){
      $jalan = JalanStatus::orderBy('id')->get();
  		return view('jalan.statusList')->with('jalan',$jalan);
    }

    public function getTambahStatus(){
  		$aksi = session('aksi', 'add');
  		return view('jalan.statusAddEdit')->with('aksi',$aksi);
  	}

  	public function getEditStatus($id){
  		$jalan = JalanStatus::find($id);
  		if ($jalan === null) {
  			return 'Data tidak ditemukan';
  		}
  		$aksi = session('aksi', 'edit');
  		return view('jalan.statusAddEdit')->with('jalan',$jalan)->with('aksi',$aksi);
  	}

  	public function postJalanStatus(Request $r){
  		$editnew = ($r->id == null) ? new JalanStatus() : JalanStatus::find($r->id);
  		$jalan = $editnew;
      $jalan->no_ruas = $r->no_ruas;
      $jalan->kode_ruas = $r->kode_ruas;
      $jalan->panjang_ruas = $r->panjang_ruas;
      $jalan->lebar_ruas = $r->lebar_ruas;
      $jalan->nama_ruas = $r->nama_ruas;
      $jalan->no_ruas = $r->no_ruas;
      $jalan->kecamatan = $r->kecamatan;
      $jalan->kelurahan = $r->kelurahan;
      $jalan->titik_pangkal = $r->titik_pangkal;
      $jalan->titik_akhir = $r->titik_akhir;
      $jalan->kelas = $r->kelas;
      $jalan->fungsi = $r->fungsi;
      $jalan->jenis_perkerasan = $r->jenis_perkerasan;
      $jalan->tahun_renovasi = $r->tahun_renovasi;
      $jalan->id_kondisi = $r->id_kondisi;
      $jalan->sempadan = $r->sempadan;
      $jalan->kondisi_sempadan = $r->kondisi_sempadan;
      $jalan->drainase = $r->drainase;
      $jalan->kondisi_drainase = $r->kondisi_drainase;

      $jalan->keterangan = $r->keterangan;
      $jalan->save();

      return redirect('admin/jalan/status');
  	}

    public function postJalanStatusShape(Request $r){
  		$data = array();
          try {
          	$jalan = JalanStatus::find($r->id);
  					$shape = $r->postgis;
  	        $jalan->shape_line = $r->shape_line;
  					$jalan->the_geom = DB::raw("ST_GeomFromText('LINESTRING({$shape})',4326)");
  	        $jalan->save();

  	        $data_array['result'] = "success";
  	        $data_array['jalan'] = $jalan;

          } catch (Exception $e) {
          	$data_array['result'] = "error";
          	$data_array['e'] = $e;
          }

        array_push($data,$data_array);
  	    return json_encode($data);

  	}

  	public function postDelete($id=''){
  		$jalan = JalanStatus::find($id);
  		$jalan->delete();

  		return redirect('admin/jalan/status');
  	}

  	public function viewMap($id){
  		$jalan = JalanStatus::find($id);
  		$shape_line = $this->getShape_Line($id);
  		return view('jalan.statusMap')->with('jalan',$jalan)->with('shape_line',$shape_line);
  	}

  	public function getShape_Line($id){
  		$jalan = JalanStatus::find($id);

  		$shape_line = $jalan->shape_line;
  		$json = (json_decode($shape_line));
  		$txt="";
  		for ($i = 0; $i < count($json); $i++) {
  	  	$txt .= $json[$i]->lat.",".$json[$i]->lng.",\n";
  	  }
  		return $txt;
  	}

  	/*public function getShapeLinePostgis($id){
  		$jalan = JalanStatus::find($id);

  		$shape_line = $jalan->shape_line;
  		$json = (json_decode($shape_line));
  		$txt="";
  		$countjson = count($json);
  		$last_index = $countjson - 1;
  		for ($i = 0; $i < $countjson; $i++) {
  			$comma = ($i == $last_index) ? "" : ",\n" ;
  	  	$txt .= $json[$i]->lng." ".$json[$i]->lat.$comma;
  	  }
  		return $txt;
  	}*/
}
