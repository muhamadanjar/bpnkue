<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\JalanFungsi;
use App\JalanStatus;

trait MapGoogle{

    
    public function redirectPath(){
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    public function showMap(){
        return view('map.google');
    }
    //Jaringan Fungsi
    public function getJaringanFungsi(){
        return JalanFungsi::orderby('id')->get();
    }

    public function postJaringanFungsi(Request $request){
        $postdata = file_get_contents("php://input");
        /*if (isset($postdata)) {
            $request = json_decode($postdata);
            $username = $request->username;
         
            if ($username != "") {
                echo "Server returns: " . $username;
            }else {
                echo "Empty username parameter!";
            }
        }else {
            echo "Not called properly with username parameter!";
        }*/
        $data = array();
        if (isset($postdata)) {
            $r = json_decode($postdata);
            $status = new JalanFungsi();
            $status->kode_ruas = $r->kode_ruas;
            $status->nama = $r->nama;
            $status->panjang = $r->panjang;
            $status->lebar = $r->lebar;
            $status->status = $r->status;
            $status->keterangan = $r->keterangan;
            $status->save();
            
            $data_array['result'] = "success";
            array_push($data,$data_array);
            return json_encode($data);
        }
        
        //$status = JalanFungsi::all();
        //return Response::json($status);
        
    }
    public function postUpdateJaringanFungsi($id){
        $postdata = file_get_contents("php://input");
        $data = array();
        if (isset($postdata)) {
            $r = json_decode($postdata);
            $status = JalanFungsi::find($id);
            $status->kode_ruas = $r->kode_ruas;
            $status->nama = $r->nama;
            $status->panjang = $r->panjang;
            $status->lebar = $r->lebar;
            $status->status = $r->status;
            $status->keterangan = $r->keterangan;
            $status->save();
            $data_array['result'] = "success";
            array_push($data,$data_array);
            return json_encode($data);
        }
         
    }

    public function postUpdateJaringanFungsiMap($id){
        $postdata = file_get_contents("php://input");
        $data = array();
        if (isset($postdata)) {
            $r = json_decode($postdata);
            $status = JalanFungsi::find($id);
            $status->shape_line = $r->shapeline;
            $status->save();
            $data_array['result'] = "success";
            array_push($data,$data_array);
            return json_encode($data);
        }
    }

    public function postDeleteJaringanFungsi($id){
        $data = array();
        $fungsi = JalanFungsi::find($id);
        $fungsi->delete();
        $data_array['result'] = "success";
        array_push($data,$data_array);
        return json_encode($data);
        
    }

    //Jaringan Status

    public function getJaringanStatus(){
        return JalanStatus::orderby('id')->get();
    }
}
