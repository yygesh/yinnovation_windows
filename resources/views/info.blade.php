@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <div class="row">
                    You are logged in!<br>
                    Users Are:-<br>
                   
                    <ol>

                    @foreach($users as $user)
                        
                            <li>{{ $user->email }}</li>
                        
                    @endforeach
                       </ol>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
