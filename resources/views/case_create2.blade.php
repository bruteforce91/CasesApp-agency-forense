@extends('layouts.app')
<body onload="mostraMessaggio()">
<script>
{{!!$script!!}}

</script>
</body>

@section('content')
<div class="container col-lg-offset-4 col-lg-4">
    <div class="row justify-content-center">
      <h1>CARICA UN'IMMAGINE</h1>

      <form action="{{route('upload')}}" enctype="multipart/form-data" method="post">
        {{csrf_field()}}
        <input type="file" name="image">
        <img src="storage/resources/prova.jpg" alt="Image">
        <input type="submit" class="btn btn-success" value="upload">
      </form>
      <script src="{{asset('js/app.js')}}"></script>
    </div>
  </div>
@endsection
