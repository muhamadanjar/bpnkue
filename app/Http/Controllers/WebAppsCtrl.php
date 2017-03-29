<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Fasilitas;
use Validator;

use Response;
use Illuminate\Support\Facades\Auth;
use App\Traits\MapGoogle;
use App\Traits\FasilitasPandeglang;

class WebAppsCtrl extends Controller {
    use MapGoogle,FasilitasPandeglang;

    //Jaringan Jalan Status

    public function InsertPostFasilitas(){
    	$data = array();
    	$postdata = file_get_contents("php://input");
    	
    	if (isset($postdata)) {
            $r = json_decode($postdata);
            
                $poi = new Fasilitas();
                $poi->daerah_irigasi = $r->daerah_irigasi;
                $poi->bendung = $r->bendung;
                $poi->jaringan_irigasi = $r->jaringan_irigasi;
                $poi->jaringan_irigasi_bangunan = $r->jaringan_irigasi_bangunan;
                $poi->saluran_primer = $r->saluran_primer;
                $poi->drain_inlet = $r->drain_inlet;
                $poi->saluran_sekunder = $r->saluran_sekunder;
                $poi->kondisi = $r->kondisi;
                if (isset($r->foto)) {
                    $poi->foto = $r->foto;
                }
                if (isset($r->x) AND isset($r->y)) {
                    $x = $r->x; $y = $r->y;
                    $poi->x = $r->x;
                    $poi->y = $r->y;
                    $poi->the_geom = DB::raw("ST_GeomFromText('POINT({$x} {$y})',4326)");
                }
                $poi->save();
                
                $data_array['result'] = "success";
                array_push($data,$data_array);
                return json_encode($data);
            //}
        }
    }

    //Login
    public function checkLogin(){
        $data = array();
        if (\Auth::guard('web')->check()) {
            $data['status'] = \Auth::guard('web')->check();
            $data['data'] = Auth::user();
        }else{
            $data['status'] = false;
        }
        
        return $data;
    }

    public function postLogin(){
        $postdata = file_get_contents("php://input");
        $r = json_decode($postdata);
        $r->token = csrf_token();
        $data = array();
        if (\Auth::attempt(['username' => $r->username, 'password' => $r->password])) {
            $data['status'] = true;
            $data['data'] = Auth::user();
            $data['token'] = csrf_token();

            return $data;
        }
        return json_encode(array('status' => false));
    }

    public function postLogout(){
        \Auth::guard()->logout();
        $data = array();
        $data['status'] = false;
        return $data;
        //$request->session()->flush();

        //$request->session()->regenerate();
    }

}
