@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   Il tuo file è stato caricato con successo!
                    <a href="user/{{ Auth::user()->id}}" button type="button" class="btn btn-primary btn-lg btn-block">Homepage</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
