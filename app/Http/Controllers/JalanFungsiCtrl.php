<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JalanFungsi;
class JalanFungsiCtrl extends Controller{
	public function __construct($value=''){
		$this->middleware('auth');
	}

	public function getIndex($value=''){
		$jalan = JalanFungsi::orderBy('id')->get();
		return view('jalan.fungsiList')->with('jalan',$jalan);
	}

	public function getTambahFungsi(){
		return view('jalan.fungsiAdd');
	}

	public function getEditFungsi($id=''){
		$jalan = JalanFungsi::find($id);
		return view('jalan.fungsiEdit')->with('jalan',$jalan);
	}

	public function postJalanFungsi(Request $request){
		$editnew = ($request->id == null) ? new JalanFungsi() : JalanFungsi::find($request->id);
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

	public function postDelete($id=''){
		$jalan = JalanFungsi::find($id);
		$jalan->delete();

		return redirect('admin/jalan/fungsi');
	}

	public function viewMap($id){
		$jalan = JalanFungsi::find($id);
		return view('jalan.FungsiMap')->with('jalan',$jalan);
	}
}
