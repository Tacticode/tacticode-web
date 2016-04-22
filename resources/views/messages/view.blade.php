{{--*/ $nav = 'messages' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">
        <i>
            @foreach ($message->user as $user)
                @if ($user->pivot->type)
                    {{$user->login}}
                @endif
            @endforeach
        </i>
        : {{$message['object']}}
    </h1>

    <p>
        {{$message['content']}}
    </p>

    <div class="row">
        <a class="btn btn-success" href="/messages/add/{{$message->id}}">@lang('messages.answer')</a>
    </div>

@endsection