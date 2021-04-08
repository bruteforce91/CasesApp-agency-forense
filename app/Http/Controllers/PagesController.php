<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//controller delle pagine
class PagesController extends Controller
{
    public function home(){
        return view('pages.homepage') ;
    }

    public function users(){
        return view('pages.user_index') ;
    }
}
