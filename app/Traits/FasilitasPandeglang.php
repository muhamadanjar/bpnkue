<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use DB;

trait FasilitasPandeglang{
	
    public function getFasilitas($limit=10){
        #header("Access-Control-Allow-Origin: *");
        #header("Access-Control-Allow-Credentials: true");
        #header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        #header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        #header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
        #header("Content-Type: application/json; charset=utf-8");
        return \Response::json(DB::table('fasilitas')->orderby('id')->limit($limit)->get());
    }

    public function getSearchFasilitas($key=''){
        return \Response::json(DB::table('fasilitas')
            ->where('fasilitas','LIKE','%'.$key.'%')
            ->orWhere('nama','LIKE','%'.$key.'%')
            ->limit(10)
            ->orderby('id')->get());
    }

    public function getDeleteFasilitas($key=''){
        return \Response::json(DB::table('fasilitas')
            ->where('fasilitas','LIKE','%'.$key.'%')
            ->orWhere('nama','LIKE','%'.$key.'%')
            ->limit(10)
            ->orderby('id')->get());
    }

    public function getPoiPandeglang(){
        return \Response::json(DB::table('poi_pandeglang')
            ->orderby('id')->get());
    }
}
