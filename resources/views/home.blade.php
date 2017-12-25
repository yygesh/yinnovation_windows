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
                    Tokens Are:-<br>

                    @if(Session::get('access_token'))
                     {{-- <a href="{{url('/user')}}">User Info</a> --}}
                     {{\Session::get('access_token')}}
                    @endif

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
