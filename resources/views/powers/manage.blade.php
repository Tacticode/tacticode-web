{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/powers.js"></script>
@endsection

@section('content')
    <h1 class="page-header">@lang('powers.manageOf', ['name' => $character->name]) <a class="btn btn-primary" href="/characters/{{$character->id}}">@lang('powers.backToCharacter')</a></h1>

    <input type="hidden" id="characterid" value="{{ $character->id }}">
    <input type="hidden" id="raceid" value="{{ $character->race_id }}">
    <input type="hidden" id="totalPowers" value="{{ $totalPowers }}">

    <div class="row">
        <div>@lang('powers.left', ['number' => '-']) <button class="btn btn-danger" onclick="resetPowers()">@lang('powers.resetAll')</button></div>
        <canvas id="powers" width="800" height="600" style="border:1px solid #000000;">
            @lang('powers.noCanvas')
        </canvas>
    </div>
@endsection