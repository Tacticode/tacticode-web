{{--*/ $nav = 'arena' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('arena.title')</h1>

    <div class="row arena">
        <div class="col-md-6 fight-type">
        	<p class="lead">Solo</p>
            <a id="solo-fight-button" href="arena/solofight"></a>
        </div>
        <div class="col-md-6 fight-type">
        	<p class="lead">Team</p>
            <a id="team-fight-button" href="arena/teamfight"></a>
        </div>
    </div>
@endsection