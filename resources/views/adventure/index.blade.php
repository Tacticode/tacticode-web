{{--*/ $nav = 'adventure' /*--}}
@extends('layouts.dashboard')

@section('content')
	<h1 class="page-header">@lang('adventure.title')</h1>

    <div class="row arena">
        <div class="col-md-4 fight-type">
            <a class="btn btn-success" href="/adventure/dungeons">@lang('adventure.dungeons')</a>
        </div>
        <div class="col-md-4 fight-type">
            <a class="btn btn-success" href="/adventure/customdungeons">@lang('adventure.customDungeons')</a>
        </div>
        <div class="col-md-4 fight-type">
            <a class="btn btn-success" href="" disabled="disabled">@lang('adventure.makeDungeon')</a>
        </div>
    </div>
@endsection