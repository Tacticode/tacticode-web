@extends('layouts.home')

@section('jumbotron')
        <h1>Tacticode</h1>
        <p>@lang('welcome.welcome')</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">@lang('navigation.learnMore') &raquo;</a></p>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>@lang('welcome.advantage1.title')</h2>
            <p>@lang('welcome.advantage1.desc')</p>
            <p><a class="btn btn-default" href="#" role="button">@lang('navigation.viewDetails') &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>@lang('welcome.advantage2.title')</h2>
            <p>@lang('welcome.advantage2.desc')</p>
            <p><a class="btn btn-default" href="#" role="button">@lang('navigation.viewDetails') &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>@lang('welcome.advantage3.title')</h2>
            <p>@lang('welcome.advantage3.desc')</p>
            <p><a class="btn btn-default" href="#" role="button">@lang('navigation.viewDetails') &raquo;</a></p>
        </div>
    </div>
@endsection