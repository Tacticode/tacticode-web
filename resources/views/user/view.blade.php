{{--*/ $nav = 'user' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">{{ucfirst($user->login)}}</h1>

    <div class="row">
    </div>
        
@endsection