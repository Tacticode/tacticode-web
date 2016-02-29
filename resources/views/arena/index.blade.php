{{--*/ $nav = 'arena' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('arena.title')</h1>

    <div class="row arena">
        <div class="col-md-6 fight-type">
            <a class="btn btn-success">@lang('arena.soloFight')</a>
        </div>
        <div class="col-md-6 fight-type">
            <a class="btn btn-success">@lang('arena.teamFight')</a>
        </div>
    </div>
@endsection