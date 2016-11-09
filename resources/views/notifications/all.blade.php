{{--*/ $nav = 'notifications' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('notifications.title')</h1>

    @if (count($notifications))

        <div class="tab-content">
            <div class="table-responsive tab-pane active" id="inbox">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr @if ($notification->seen == 0) class="new" @endif>
                                <td>{{ $notification->title }}</td>
                                <td>{{ $notification->content }}</td>
                                <td>{{ $notification->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="row">
            <i>@lang('notifications.no_notifications')</i>
        </div>
    @endif
@endsection