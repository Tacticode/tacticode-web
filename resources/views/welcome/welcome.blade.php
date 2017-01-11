@extends('layouts.home')

@section('jumbotron')
        <h1>Tacticode</h1>
        <p>@lang('welcome.welcome')</p>
        <p><a class="btn btn-primary btn-lg" href="https://docs.tacticode.net/" role="button">@lang('navigation.learnMore') &raquo;</a></p>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <a href="/img/advantage1.png" data-lightbox="welcome"><img src="/img/advantage1.png" style="width: 80%; height: 200px;"></a>
            <h2>@lang('welcome.advantage1.title')</h2>
            <p>@lang('welcome.advantage1.desc')</p>
            <p><a class="btn btn-default" href="https://docs.tacticode.net/game/teams/" role="button">@lang('navigation.viewDetails') &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <a href="/img/advantage2.png" data-lightbox="welcome"><img src="/img/advantage2.png" style="width: 80%; height: 200px;"></a>
            <h2>@lang('welcome.advantage2.title')</h2>
            <p>@lang('welcome.advantage2.desc')</p>
            <p><a class="btn btn-default" href="https://docs.tacticode.net/game/talents/" role="button">@lang('navigation.viewDetails') &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <a href="/img/advantage3.png" data-lightbox="welcome"><img src="/img/advantage3.png" style="width: 80%; height: 200px;"></a>
            <h2>@lang('welcome.advantage3.title')</h2>
            <p>@lang('welcome.advantage3.desc')</p>
            <p><a class="btn btn-default" href="https://docs.tacticode.net/scripting/getting-started/" role="button">@lang('navigation.viewDetails') &raquo;</a></p>
        </div>
    </div>

    <!-- Lightbox -->
        <link rel="stylesheet" href="/css/lightbox.min.css">
        <script src="/js/lightbox.js"></script>
@endsection