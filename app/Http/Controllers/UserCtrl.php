<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserCtrl extends Controller
{
    public function create()
    {
        $this->authorize('create.user');
    }

    public function create_dua(){
        if (auth()->user()->can('create.user')) {
            return view('users.create');
        }
 
        return abort(403);
    }
}
