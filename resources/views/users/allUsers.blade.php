@extends('layouts.app')
@section('content')

</section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>
                <form class="" action="index.html" method="post">
                  <table>
                    <thead>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Tipo Utente</th>
                    </thead>
                    <tbody>
                      <?php foreach ($utenti as $user): ?>
                        <tr>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->type_id}}</td>
                        </tr>
                      <?php endforeach; ?>

                  </tbody>
                </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
