<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Auth;
use App;
use DB;

class HomeController extends Controller
{
    public function index() {

    }

    public function changLang(Request $request) {

    }
    
    public function policy() {

        return view('policy');
    }



}
