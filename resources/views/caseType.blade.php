@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <h1>Scegli la tipologia</h1>
       <?php foreach ($array as $type ): ?>
               <a href="caseType/{{Auth::user()->type_id}}" button type="button" class="btn btn-primary btn-lg btn-block">{{$type}}</button></a>
        <?php endforeach; ?>

    </div>
  </div>
@endsection
