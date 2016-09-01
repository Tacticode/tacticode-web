{{--*/ $nav = 'scripts' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/codemirror.js"></script>
    <script src="/js/modes/javascript.js"></script>
@endsection

@section('page-styles')
    <link rel="stylesheet" href="/css/codemirror.css">
@endsection


@section('content')
    <h1 class="page-header">
        @lang('scripts.add')
        <a href="http://api.net" target="_blank" class="btn btn-primary">@lang('scripts.documentation')</a>
    </h1>

    {!! Form::open() !!}

        <div class="form-group @if ($errors->has('name')) has-error @endif">
            {!! Form::label('name', trans('scripts.name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('scripts.name')]) !!}
            <div class="help-block">
                @foreach ($errors->get('name') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>

        <div class="form-group has-error">
            <div class="help-block">
                @foreach ($errors->get('content') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    	<textarea id="codemirror" style="display:none" name="content">{{$default}}</textarea>

    	<div class="spacer"></div>

    	<div class="form-group">
            {!! Form::submit(trans('navigation.add'), ['class' => 'btn btn-primary form-control']) !!}
        </div>

    {!! Form::close() !!}

    <script>
    	$(document).ready(function() {

    		var editor = CodeMirror.fromTextArea(document.getElementById('codemirror'), {
    			lineNumbers: true,
    			mode: "javascript",
    			matchBrackets: true
			});
    	});
    </script>
@endsection