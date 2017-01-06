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
            <div id="name_field" class="col-md-4" style="display: none;">
                {!! Form::text('name', $script->name, ['class' => 'form-control', 'placeholder' => trans('scripts.name')]) !!}
            </div>
            <span class="clickable">{{ $script->name }}</span>
            <a href="https://api.tacticode.net" target="_blank" class="btn btn-primary">@lang('scripts.documentation')</a>
        </h1>

    	<textarea id="codemirror" style="display:none" name="content">{{ (old('content') != null ? old('content') : $script->content) }}</textarea>

    	<div class="spacer"></div>

    	<div class="form-group">
            {!! Form::submit(trans('navigation.update'), ['class' => 'btn btn-primary form-control']) !!}
        </div>

    {!! Form::close() !!}

    <div style="margin-bottom:10px;">
        <input type="hidden" id="_token" value="{{ csrf_token() }}" />
        <a href="" style="display:none;" target="_blank" id="redirect"></a>
        {!! Form::select('character_id', $characters) !!}
        {!! Form::button('Test Script', array('class' => 'btn btn-warning', 'id' => 'test_fight')) !!}
    </div>

    <script>
    	$(document).ready(function() {

    		var editor = CodeMirror.fromTextArea(document.getElementById('codemirror'), {
    			lineNumbers: true,
    			mode: "javascript",
    			matchBrackets: true
			});
            editor.setSize("100%", 650);

            $('h1 span').click(function() {

                $("#name_field").show();
                $('h1 span').hide();
            });

            $('#test_fight').click(function() {
                if ($('select[name="character_id"] option').size() == 0)
                    return ;
                var data;

                data = {
                    'character_id': $('select[name="character_id"]').val(),
                    'character_script': editor.getValue(),
                    '_token': $('#_token').val()
                }

                $.ajax({
                    type: 'post',
                    url: '/arena/testfight',
                    data: data,
                    success: function(data) {

                        if (data.result == 'success') {
                            console.log('result:' + data.url);
                            $("#redirect").attr('href', data.url);
                            document.getElementById('redirect').click();
                        } else {
                            console.log(data.description);
                        }
                    }
                }, 'json');
            });
    	});
    </script>
@endsection