<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\casesType;
class caseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     try{
          $Type = casesType::all();
          $getId = Auth::user()->id;
          $cont=0;
          foreach ($Type as $key => $value) {
            $cont++;
            //$obj1=$Type[$key]->tipologia;
          }
          $array=[$cont];

          //memorizza tutte le tipologia in un array
          foreach ($Type as $key => $value) {
            $array[$key]=$Type[$key]->tipologia;
          }
          //$obj1=$Type[0]->tipologia;

         $data=[
            'id'=>$getId
          ];

        //return response()->json($array[0]);
      return view('caseType',compact('array'))->with($array)->with($data);
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
    public function show($id)
    {
         $type = casesType::where('id', $id)->first();
         $objname=$type->tipologia;
         $objscript=$type->script;
         $objview=$type->view;



         // INIZIO cripto
         $string=$objscript;
         $public_key=Auth::User()->public; //per utente da DB
         $private_key=Auth::User()->private; //per utente da DB

         //decodifico lo script salvato sul db in base64
         $script=base64_decode($string);
         //crittografia del testo (javascript)
         $double_encrypted_script=$this->myEncrypt($script,$public_key,$private_key);
         //FINE cripto


         //conversione da base64 dei file script e view
         //$script=base64_decode($objscript);
        // $view=base64_decode($objview);

         //salvataggio file in locale
      //   Storage::disk('local')->put('newv.blade.php', $view);
      //   Storage::disk('local')->put('alert.js', $script);


         $data=[
           'name_type'=>$objname,
           'script'=>$string,
           'view'=>$objview,
           'double_encrypted_script'=>$double_encrypted_script,
           'public_key'=>$public_key,
         ];
      //  return response()->json($data);
        //return view('viewDb')->with($data);
        return view($objview)->with($data);
      //  return view('storage.app.public.newView')->with($data);
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
    public function image(){

    }

    private function myEncrypt($string, $public_key,$private_key)
    {
        //Restituisce la lunghezza della cifra in caso di successo
        $ivLength = openssl_cipher_iv_length("AES-256-CBC");
        //Genera una stringa di byte pseudo-casuali, con il numero di byte determinato dal $ivLength.
        $iv = openssl_random_pseudo_bytes($ivLength);

        $salt = openssl_random_pseudo_bytes(256);
        $iterations = 999;
        //Genera una derivazione della chiave PBKDF2 di una password fornita
        //Parametri: algo Nome algoritmo di hashing selezionato (es MD5 , sha256 , haval160,4 , ecc ..)
        //La key da utilizzare per la derivazione.
        //Il sale da utilizzare per la derivazione. Questo valore dovrebbe essere generato in modo casuale.
        //Il numero di iterazioni interne da eseguire per la derivazione.
        //La lunghezza della stringa di output
        $hashKey_public = hash_pbkdf2('sha512', $public_key, $salt, $iterations, ($this->encryptMethodLength() / 4));
        $hashKey_private = hash_pbkdf2('sha512', $private_key, $salt, $iterations, ($this->encryptMethodLength() / 4));
         // $encryptedString = openssl_encrypt($string, "AES-256-CBC", hex2bin($hashKey_private), OPENSSL_RAW_DATA, $iv);
         // $encryptedString = openssl_encrypt($encryptedString, "AES-256-CBC", hex2bin($hashKey_public), OPENSSL_RAW_DATA, $iv);

         //Crittografa i dati dati con il metodo e la chiave forniti, restituisce una stringa codificata raw
         //parametri:I dati del messaggio in chiaro da crittografare.
         //Il metodo di cifratura. Per un elenco dei metodi di cifratura disponibil
         //Decodifica una stringa binaria codificata esadecimalmente(hashkeyprivate)
         //è una disgiunzione bit a bit delle bandiere OPENSSL_RAW_DAT
         //Un vettore di inizializzazione non NULL
        $encryptedString = openssl_encrypt($string, "AES-256-CBC", hex2bin($hashKey_private), OPENSSL_RAW_DATA, $iv);
        $encryptedString = base64_encode($encryptedString);
        $encryptedString = openssl_encrypt($encryptedString, "AES-256-CBC", hex2bin($hashKey_public), OPENSSL_RAW_DATA, $iv);
        $encryptedString = base64_encode($encryptedString);
        //distruggo l'
        unset($hashKey);
        $output = ['ciphertext' => $encryptedString, 'iv' => bin2hex($iv), 'salt' => bin2hex($salt), 'iterations' => $iterations];
        unset($encryptedString, $iterations, $iv, $ivLength, $salt);
        return base64_encode(json_encode($output));
    }

    protected function encryptMethodLength() {
        $number = filter_var("AES-256-CBC", FILTER_SANITIZE_NUMBER_INT);
        return intval(abs($number));
    }// encryptMethodLength


}
