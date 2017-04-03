<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poi;
class PoiCtrl extends Controller{
	public function __construct(){
		$this->middleware('auth');
		
	}
    public function getIndex($value=''){
    	session(['route_link' => 'normal']);
    	$poi = Poi::get();
    	return view('poi.poiList')->with('poi',$poi);
    }

    public function getTambah(){
    	$aksi = session(['aksi' => 'add']);
    	return view('poi.poiAddEdit')->with('aksi',$aksi);
    }

    public function getEdit($id=''){
    	$aksi = session(['aksi' => 'edit']);
    	return view('poi.poiAddEdit')->with('aksi',$aksi);
    }

    public function postPoi(Request $r){
    	$editnew = ($r->id == null) ? new Poi() : Poi::find($r->id);
		$poi = $editnew;
		$poi->daerah_irigasi = $r->daerah_irigasi;
		$poi->bendung = $r->bendung;
		$poi->jaringan_irigasi = $r->jaringan_irigasi;
		$poi->jaringan_irigasi_bangunan = $r->jaringan_irigasi_bangunan;
		$poi->saluran_primer = $r->saluran_primer;
		$poi->drain_inlet = $r->drain_inlet;
		$poi->saluran_sekunder = $r->saluran_sekunder;
		$poi->kondisi = $r->kondisi;
		$poi->foto = $r->foto;
		//$poi->x = $r->daerah_irigasi;
		//$poi->y = $r->daerah_irigasi;
		$poi->save();

		return redirect('admin/poi');
    }
}
