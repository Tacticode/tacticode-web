@extends('layouts.dashboard')

@section('content')

    <h1 class="page-header">
        {{ $character->name }} ({{ $character->race->name }}) - <a href="/user/{{$character->user->id}}">{{ $character->user->login }}</a>
    </h1>

    <div class="row">
        @include('partials.raceimg', ['race' => $character->race->name])
    </div>

    @include('characters.history', ['character' => $character, 'full' => false])
@endsection