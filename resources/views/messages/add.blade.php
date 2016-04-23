{{--*/ $nav = 'messages' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('messages.add')</h1>

    <input id="users" value="{{$users}}" type="hidden">

    {!! Form::open() !!}
    
        <div class="form-group @if ($errors->has('to')) has-error @endif">
            {!! Form::label('to', trans('messages.to')) !!}
            @if ($message)
                @foreach ($message->user as $user)
                    @if ($user->pivot->type)
                        {!! Form::text('to', $user->login, ['class' => 'form-control', 'placeholder' => trans('messages.to')]) !!}
                    @endif
                @endforeach
            @else
                {!! Form::text('to', null, ['class' => 'form-control', 'placeholder' => trans('messages.to')]) !!}
            @endif
            <div class="help-block">
                @foreach ($errors->get('to') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>

        <div class="form-group @if ($errors->has('object')) has-error @endif">
            {!! Form::label('object', trans('messages.object')) !!}
            @if ($message)
                {!! Form::text('object', 'Re: ' . $message->object, ['class' => 'form-control', 'placeholder' => trans('messages.object')]) !!}
            @else
                {!! Form::text('object', null, ['class' => 'form-control', 'placeholder' => trans('messages.object')]) !!}
            @endif
            <div class="help-block">
                @foreach ($errors->get('object') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>

        <div class="form-group @if ($errors->has('message')) has-error @endif">
            {!! Form::label('content', trans('messages.message')) !!}
            {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => trans('messages.message')]) !!}
            <div class="help-block">
                @foreach ($errors->get('content') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit(trans('messages.send'), ['class' => 'btn btn-primary form-control']) !!}
        </div>

    {!! Form::close() !!}

    <script>
    $(function() {

        var users = $.parseJSON($('#users').val());
        $('#users').remove();

        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }

        $('#to').bind('keydown', function(event) {
            if (event.keyCode == $.ui.keyCode.TAB && $(this).autocomplete('instance').menu.active)
                event.preventDefault();
        }).autocomplete({
            minLength: 0,
            source: function(request, response) {
                
                response($.ui.autocomplete.filter(users, extractLast(request.term)));
            }, focus: function() {
                
                return false;
            }, select: function(event, ui) {
                
                var terms = split(this.value);
                terms.pop();
                terms.push(ui.item.value);
                terms.push('');
                this.value = terms.join(', ');
                return false;
            }
        })
    });
    </script>

@endsection