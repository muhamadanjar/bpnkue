<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\WebCtrl;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $r)
    {
        $this->middleware('auth');
        $this->_setting = new WebCtrl();
        $this->_r = $r;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $this->_setting->getVisitor($this->_r);
        $jumlah = array();

        $jumlah_user = $this->getJumlahUser();
        $jumlah_visit = $this->getJumlahVisitor();
        $jumlah_fasilitas = $this->getJumlahFasilitas();

        $jumlah['user'] = $jumlah_user;
        $jumlah['visit'] = $jumlah_visit;
        $jumlah['fasilitas'] = $jumlah_fasilitas;

        return view('master.dashboard')
        ->with('total',$jumlah);
    }

    public function getJumlahKuesioner(){
        $query = "SELECT COUNT(*) as totalCount FROM kuesioner_umk";

        $rec = DB::select(DB::raw($query));
        $total = $rec[0]->totalcount;
        return $total;
    }

    public function getJumlahFasilitas(){
        $query = "SELECT COUNT(*) as totalCount FROM poi_pandeglang";

        $rec = DB::select(DB::raw($query));
        $total = $rec[0]->totalcount;
        return $total;
    }

    public function getJumlahUser(){
        $query = "SELECT COUNT(*) as totalCount FROM users";

        $rec = DB::select(DB::raw($query));
        $total = $rec[0]->totalcount;
        return $total;
    }

    public function getJumlahVisitor(){
        $query = "SELECT COUNT(*) as totalCount FROM statistik_web";

        $rec = DB::select(DB::raw($query));
        $total = $rec[0]->totalcount;
        return $total;
    }
}
