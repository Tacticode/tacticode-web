{{--*/ $nav = 'adventure' /*--}}
@extends('layouts.dashboard')

@section('content')
	<h1 class="page-header">@lang('adventure.title')</h1>

    <div class="row arena">
        <div class="col-md-4 fight-type">
            <a class="btn btn-success" href="/adventure">@lang('adventure.back')</a>
        </div>
    </div>
@endsection