<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JalanFungsi;
use DB;
class JalanFungsiCtrl extends Controller{
	public function __construct($value=''){
		$this->middleware('auth');
		//get return geom to coordinate
		//ST_X(the_geom), ST_Y(the_geom), ST_AsText(the_geom)
	}

	public function getIndex($value=''){
		$jalan = JalanFungsi::orderBy('id')->get();
		return view('jalan.fungsiList')->with('jalan',$jalan);
	}

	public function getTambahFungsi(){
		$aksi = session(['aksi' => 'add']);
		return view('jalan.fungsiAddEdit')->with('aksi',$aksi);
	}

	public function getEditFungsi($id){
		$jalan = JalanFungsi::find($id);
		if ($jalan === null) {
			return 'Data tidak ditemukan';
		}
		$aksi = session(['aksi' => 'edit']);
		return view('jalan.fungsiAddEdit')->with('jalan',$jalan)->with('aksi',$aksi);
	}

	public function postJalanFungsi(Request $r){
		$editnew = ($r->id == null) ? new JalanFungsi() : JalanFungsi::find($r->id);
		$jalan = $editnew;
		$jalan->kode_ruas = $r->kode_ruas;
    $jalan->nama = $r->nama;
    $jalan->panjang = $r->panjang;
    $jalan->lebar = $r->lebar;
    $jalan->status = $r->status;
    $jalan->keterangan = $r->keterangan;
    $jalan->save();
		return redirect('admin/jalan/fungsi');
	}

	public function postJalanFungsiShape(Request $r){
		$data = array();
        try {
        	$jalan = JalanFungsi::find($r->id);
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
		$jalan = JalanFungsi::find($id);
		$jalan->delete();

		return redirect('admin/jalan/fungsi');
	}

	public function viewMap($id){
		$jalan = JalanFungsi::find($id);
		$shape_line = $this->getShape_Line($id);
		return view('jalan.FungsiMap')->with('jalan',$jalan)->with('shape_line',$shape_line);
	}

	public function getShape_Line($id){
		$jalan = JalanFungsi::find($id);

		$shape_line = $jalan->shape_line;
		$json = (json_decode($shape_line));
		$txt="";
		for ($i = 0; $i < count($json); $i++) {
	  	$txt .= $json[$i]->lat.",".$json[$i]->lng.",\n";
	  }
		return $txt;
	}

	public function getShapeLinePostgis($id){
		$jalan = JalanFungsi::find($id);

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
	}
}
