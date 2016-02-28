{{--*/ $nav = 'arena' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Arena</h1>

    <div class="row arena">
        <div class="col-md-6 fight-type">
            <a class="btn btn-success">Solo fight</a>
        </div>
        <div class="col-md-6 fight-type">
            <a class="btn btn-success">Team fight</a>
        </div>
    </div>
@endsection