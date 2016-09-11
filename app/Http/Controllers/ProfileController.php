<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('verify');
    }
    
    public function index() {
    	return view('admin.profile') ;
    }
}
