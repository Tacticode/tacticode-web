{{--*/ $nav = 'messages' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('messages.title')</h1>

    @if (count($messages))

        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#inbox" aria-controls="home" role="tab" data-toggle="tab">@lang('messages.inbox')</a></li>
            <li><a href="#sendbox" aria-controls="profile" role="tab" data-toggle="tab">@lang('messages.sendbox')</a></li>
        </ul>

        <div class="tab-content">
            <div class="table-responsive tab-pane active" id="inbox">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('messages.object')</th>
                            <th>@lang('messages.from')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            @if (!$message->pivot->type)
                                <tr @if ($message->pivot->seen == 0) class="new" @endif>
                                    <td>{{ $message->object }}</td>
                                    <td>
                                        @foreach ($message->user as $user)
                                            @if ($user->pivot->type)
                                                {{$user->login}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="/messages/{{ $message->id }}" class="btn btn-primary">@lang('messages.read')</a>
                                        <a class="btn btn-danger" href="/messages/delete/{{ $message->id }}" onclick="if (!confirm('@lang('messages.confirmDelete')')) return false">@lang('navigation.delete')</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-responsive tab-pane" id="sendbox">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('messages.object')</th>
                            <th>@lang('messages.to')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            @if ($message->pivot->type)
                                <tr>
                                    <td>{{ $message->object }}</td>
                                    <td>
                                        @foreach ($message->user as $user)
                                            @if (!$user->pivot->type)
                                                {{$user->login}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="/messages/{{ $message->id }}" class="btn btn-primary">@lang('messages.read')</a>
                                        <a class="btn btn-danger" href="/messages/delete/{{ $message->id }}" onclick="if (!confirm('@lang('messages.confirmDelete')')) return false">@lang('navigation.delete')</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="row">
            <i>@lang('messages.noMessages', ['link' => '/messages/add'])</i>
        </div>
    @endif

    <div class="row">
        <a class="btn btn-success" href="/messages/add">@lang('messages.add')</a>
    </div>
@endsection