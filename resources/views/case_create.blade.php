@extends('layouts.app')
<!--<body onload="mostraMessaggio()">  !-->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script>
var private_key="{{ request()->cookie('key_private')}}";// caricata dal coockie
var double_encrypted_script='{{$double_encrypted_script}}';
var public_key='{{$public_key}}';
var decrypted_script = decrypt(double_encrypted_script, public_key,private_key);

//console.log(original);

function decrypt(encryptedString, public_key, private_key) {
        var json = JSON.parse(CryptoJS.enc.Utf8.stringify(CryptoJS.enc.Base64.parse(encryptedString)));
        var salt = CryptoJS.enc.Hex.parse(json.salt);
        var iv = CryptoJS.enc.Hex.parse(json.iv);
        var encrypted = json.ciphertext;// no need to base64 decode.


        var iterations = parseInt(json.iterations);
        if (iterations <= 0) {
            iterations = 999;
        }
        var encryptMethodL = (encryptMethodLength()/4);// example: AES number is 256 / 4 = 64
        //generated with public_key
        var public_hashKey = CryptoJS.PBKDF2(public_key, salt, {'hasher': CryptoJS.algo.SHA512, 'keySize': (encryptMethodL/8), 'iterations': iterations});
        //generated with private_key
        var private_hashKey = CryptoJS.PBKDF2(private_key, salt, {'hasher': CryptoJS.algo.SHA512, 'keySize': (encryptMethodL/8), 'iterations': iterations});
        //only one decript
        var public_decrypted_private_encrypted = CryptoJS.AES.decrypt(encrypted, public_hashKey, {'mode': CryptoJS.mode.CBC, 'iv': iv}).toString(CryptoJS.enc.Utf8);
        //double decript
        var final_decrypted = CryptoJS.AES.decrypt(public_decrypted_private_encrypted, private_hashKey, {'mode': CryptoJS.mode.CBC, 'iv': iv});
        return final_decrypted.toString(CryptoJS.enc.Utf8);
    }// decrypt

function encryptMethodLength() {
        var encryptMethod = 'AES-256-CBC';
        // get only number from string.
        // @link https://stackoverflow.com/a/10003709/128761 Reference.
        var aesNumber = encryptMethod.match(/\d+/)[0];
        return parseInt(aesNumber);
    }// encryptMethodLength
</script>


@section('content')
<div class="container col-lg-offset-2 col-lg-4">
    <h1>CARICA UN'IMMAGINE</h1>
    <div class="row justify-content-center">
      <form>
        </div>
        <div class="form-group">
          <label for="script_criptato">Script Criptato</label>
          <textarea  class="form-control" id="script criptato" rows="3">{{$script}}</textarea>
          <button type="button" onclick="decodifica()" hidden=true;>Decode</button>
          <!--<button type="button" onclick="decodifica()">Decode</button> !-->
          <label for="script_decrypt">Script Decriptato</label>
        <textarea  class="form-control" id="script decriptato" rows="3"></textarea>
        <!--effettuo la decodifica se ho il cookie  !-->
        <script>
          function decodifica() {
              var risultato=document.getElementById('script decriptato').value=decrypted_script.toString();
              if(risultato.get!=""){
                  document.getElementById('submit').hidden=false;
                }
              }
              </script>
        </div>
      </form>
      <form action="{{route('upload')}}" enctype="multipart/form-data" method="post">
        {{csrf_field()}}
        <input type="file" name="image">
        <img src="" alt="Image">
        <!--<img src="storage/resources/prova.jpg" alt="Image"> !-->
        <input type="submit" class="btn btn-success" value="upload"  id="submit">
      </form>

    </div>
@endsection
