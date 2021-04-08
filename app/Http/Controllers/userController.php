<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\User;
use App\UserType;
use App\casesType;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //funzione che prende i dati dal db
    public function index()
    {
           try{
                  //in questo modo ottieni i dati users presenti nel db
                  $utenti = User::all();
              /*   $data=[
                    'utenti'=>$utenti
                  ];*/
                  //return response()->json(['id' => $id]);
                  return view('users.allUsers',compact('utenti'));
                  //return view('users.allUsers',compact('utenti'))->with($data);
            }catch (\Exception $e){
                return response()->json([
                    'status' => false,
                    'message' => 'Errore'
                ]);
              }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $id=\Auth::user()->id;
      try{
           $utenti = User::with('userType')->where('id', $id)->get();
           if($utenti[0]->type_id == 1){
             $tipo = 'Utente';
           } else if ($utenti[0]->type_id == 2) {
             $tipo = 'Amministratore';
           } else {
             $tipo = 'Errore tipo';
           }
           $objname=$utenti[0]->name;
           $objemail=$utenti[0]->email;
           $objtype=$tipo;
           $objid=$utenti[0]->id;
           // return response()->json($utenti);
           $data=[

             'name_utente'=>$objname,
             'email_utente'=>$objemail,
             'tipo_utente'=>$objtype,
             'id'=>$objid
           ];
      
            return view('users.index', ['user' => User::findOrFail($id)])->with($data);
          // return view('users.index',compact('user'))->with($data);

          // return response()->json($obj);
          }catch (\Exception $e){
           return response()->json([
               'status' => false,
               'message' => 'Errore',
               'errore' => $e->getMessage(),
           ]);
       }
    }
    public function user($id){

    echo $id;

}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
