{{--*/ $nav = 'arena' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('arena.soloFight')</h1>

    <div class="row arena">
		<div class="row placeholders">
	        @if (count($characters))
	            @foreach ($characters as $character)
	                <div class="col-xs-6 col-sm-3 placeholder">
	                    <h4>{{ $character->name }}</h4>
	                    <span class="text-muted"><a href="/arena/solofight/{{ $character->id }}">@lang('arena.launchFight')</a></span>
	                </div>
	            @endforeach
	        @else
	            <div class="col-xs-12">
	                <i>@lang('characters.noCharacters', ['link' => '/characters/add'])</i>
	            </div>
	        @endif
	    </div>
    </div>
@endsection