@extends('layouts.home')

@section('jumbotron')
        <h1>@lang('terms.title')</h1>
        <p>@lang('terms.subTitle')</p>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>@lang('terms.article1.title')</h2>
            <p>@lang('terms.article1.content')</p>
        </div>
    </div>
@endsection