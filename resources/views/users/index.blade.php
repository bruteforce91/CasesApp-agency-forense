@extends('layouts.app')

	@section('content')
		<div class="container">
		    <div class="row justify-content-center">
					@if (session('status'))
							<div class="alert alert-success" role="alert">
									{{ session('status') }}
							</div>
					@endif
					<h1>Welcome {{$name_utente}}</h1>
				 	<table class="table table-striped">
		   	<thead>
		     <tr>
					 <th scope="col"></th>
		       <th scope="col">Nome</th>
		       <th scope="col">Email</th>
		       <th scope="col">Tipo utente</th>
		     </tr>
		   </thead>
		   <tbody>
		     <tr>
		       <th scope="row"></th>
		       <td>{{$name_utente}}</td>
		       <td>{{$email_utente}}</td>
		       <td>{{$tipo_utente}}</td>
		     </tr>
		   </tbody>
		 </table>

				 <a href="{{route('casetype')}}" class= "button"
	 				 style="box-shadow: 0px 0px 0px 2px #9fb4f2;
	 				 background:-moz-linear-gradient(top, #7892c2 5%, #476e9e 100%);
	 				 background:-webkit-linear-gradient(top, #7892c2 5%, #476e9e 100%);
	 				 background:-o-linear-gradient(top, #7892c2 5%, #476e9e 100%);
	 				 background:-ms-linear-gradient(top, #7892c2 5%, #476e9e 100%);
	 				 background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
	 				 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#7892c2', endColorstr='#476e9e',GradientType=0);
	 				 background-color:#7892c2;
	 				 -moz-border-radius:10px;
	 				 -webkit-border-radius:10px;
	 				 border-radius:10px;
	 				 border:1px solid #4e6096;
	 				 display:inline-block;
	 				 cursor:pointer;
	 				 color:#ffffff;
	 				 font-family:Arial;
	 				 font-size:19px;
	 				 padding:12px 37px;
	 				 text-decoration:none;
	 				 text-shadow:0px 1px 0px #283966;">Open Case</a>
	 </div>
	 <div>
		 <div class="row justify-content-center">
				 <div class="col-md-8">
						 <div class="card">
							 <!--
		 		<textarea rows="4" cols="50">
						Si prega di salvare la chiave private:
		 				{{ request()->cookie('keyprivate')}}
	 			</textarea> !-->
			</div>
			
		</div>
	</div>
	 </div>
</div>
@endsection
