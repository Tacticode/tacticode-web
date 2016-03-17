{{--*/ $nav = 'arena' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('arena.teamFight')</h1>

    <div class="row arena">
		<div class="row placeholders">
	        @if (count($teams))
	            @foreach ($teams as $team)
	                <div class="col-xs-6 col-sm-3 placeholder">
	                    <h4>{{ $team->name }}</h4>
	                    <span class="text-muted"><a href="/arena/teamfight/{{ $team->id }}">@lang('arena.launchFight')</a></span>
	                </div>
	            @endforeach
	        @else
	            <div class="col-xs-12">
	                <i>@lang('teams.noTeams', ['link' => '/teams/add'])</i>
	            </div>
	        @endif
	    </div>
    </div>
@endsection