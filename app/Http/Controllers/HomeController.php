<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\WebCtrl;

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
    public function index()
    {
        $this->_setting->getVisitor($this->_r);
        return view('master.dashboard');
    }
}
