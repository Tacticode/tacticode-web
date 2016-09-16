@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">{{ $team->name }} - {{$team->user->login}}</h1>

    <div class="row placeholders">
        @if (count($team->character))
            @foreach ($team->character as $key => $character)
                <div class="col-xs-6 col-sm-3 placeholder">
                    <div>
                        @include('partials.raceimg', ['race' => $character->race->name])
                    </div>
                    <h4>{{ $character->name }}</h4>
                    <span class="text-muted"><a href="/characters/{{ $character->id }}">@lang('navigation.seeMore')</a></span>
                </div>
            @endforeach
        @else
            <div class="col-xs-12">
                <i>@lang('teams.noCharacters')</i>
            </div>
        @endif
    </div>

    @include('teams.history', ['team' => $team, 'full' => false])
@endsection