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
    {!! Form::open(['url' => '/scripts/' . $script->id]) !!}

        <h1 class="page-header">
            <span class="clickable">{{ $script->name }}</span>
            <a href="https://api.tacticode.net" target="_blank" class="btn btn-primary">@lang('scripts.documentation')</a></h1>
        <div class="page-header row" style="display: none">
            <div class="col-md-4">
                {!! Form::text('name', $script->name, ['class' => 'form-control', 'placeholder' => trans('scripts.name')]) !!}
            </div>
        </div>

    	<textarea id="codemirror" style="display:none" name="content">{{ $script->content }}</textarea>

    	<div class="spacer"></div>

    	<div class="form-group">
            {!! Form::submit(trans('navigation.update'), ['class' => 'btn btn-primary form-control']) !!}
        </div>

    {!! Form::close() !!}

    <script>
    	$(document).ready(function() {

    		var editor = CodeMirror.fromTextArea(document.getElementById('codemirror'), {
    			lineNumbers: true,
    			mode: "javascript",
    			matchBrackets: true
			});

            $('h1 span').click(function() {

                $(".page-header").show();
                $('h1 span').hide();
            });
    	});
    </script>
@endsection