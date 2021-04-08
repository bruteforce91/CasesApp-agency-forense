<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //return redirect()->url('user/'. Auth::user()->id);
      $cookie_name="key_private";
      $cookie_value=Auth::user()->private;
      //$cookie_value=$private_key;
      Cookie::queue(Cookie::forever($cookie_name,$cookie_value));
      return \Redirect::route('homeuser');

        //questa funzione prende l'id corrente
        /*$getId = Auth::user()->id;
        $data=[
        'id'=>$getId
        ];
        return view('home')->with($data);*/
    }
}
