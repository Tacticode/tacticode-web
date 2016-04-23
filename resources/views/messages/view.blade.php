{{--*/ $nav = 'messages' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h2 class="page-header">
        <?php $to = []; ?>
        @foreach ($message->user as $user)
            @if ($user->pivot->type)
                <i>@lang('messages.from')</i> : {{$user->login}}<br>
            @else
                <?php $to[] = $user->login ?>
            @endif
        @endforeach
        <i>@lang('messages.object')</i> : {{$message['object']}}<br>
        <i>@lang('messages.to')</i> : {{implode($to, ',')}}
    </h2>

    <p>
        {{$message['content']}}
    </p>

    <div class="row">
        <a class="btn btn-success" href="/messages/add/{{$message->id}}">@lang('messages.answer')</a>
    </div>

@endsection