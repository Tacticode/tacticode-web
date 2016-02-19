{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/powers.js"></script>
@endsection

@section('content')
    <h1 class="page-header">Manage powers of {{ $character->name }} <a class="btn btn-primary" href="/characters/{{$character->id}}">Back to character</a></h1>

    <div class="row">
        <canvas id="powers" width="800" height="600" style="border:1px solid #000000;">
            Your browser doesn't support canvas
        </canvas>
        <div><span id="selectedCircle"></span></div>
    </div>
@endsection