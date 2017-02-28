<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\JalanStatus;
use App\JalanFungsi;
use Response;
use Illuminate\Support\Facades\Auth;

class WebAppsCtrl extends Controller {

    protected function validateLogin($request){
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);
    }
    protected function attemptLogin($request){
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }
    protected function credentials($request){
        return $request->only('username', 'password');
    }
    protected function guard(){
        return Auth::guard();
    }
    public function login(Request $request){
        $postdata = file_get_contents("php://input");
        $this->validateLogin($postdata);

        if ($this->attemptLogin($postdata)) {
            return $this->sendLoginResponse($postdata);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

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


    //Jaringan Jalan Status

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
    
}
