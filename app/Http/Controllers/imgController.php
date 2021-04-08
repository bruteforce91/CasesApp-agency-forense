<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\case;
class imgController extends Controller
{
  public function upload(Request $request){
    if($request->hasFile('image')){
      //return 'true';
      //getClientOriginalName serve a restituire il nome originale dell'img
    // $imagename=$request->image->getClientOriginalName();
      $request->image->store('resources.img');
      return view('upload');
    }

    //return back;
    //return $request->all();
  }
    //
}
