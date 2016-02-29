{{--*/ $nav = 'leaderboard' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('leaderboard.title')</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@lang('leaderboard.position')</th>
                    <th>@lang('leaderboard.name')</th>
                    <th>@lang('leaderboard.score')</th>
                </tr>
            </thead>
            <tbody>
            	@foreach ($users as $user)
            	 	@if ($user->id == Auth::user()->id)
            	 		<tr class="info">
		                    <td>?</td>
		                    <td>{{ $user->login }}</td>
		                    <td>?</td>
		                    <td><a class="btn btn-primary" href="/user">@lang('leaderboard.myProfile')</a></td>
		                </tr>
            	 	@else
		                <tr>
		                    <td>?</td>
		                    <td>{{ $user->login }}</td>
		                    <td>?</td>
		                    <td><a class="btn btn-primary" href="/users/{{ $user->id }}">@lang('navigation.view')</a></td>
		                </tr>
	                @endif
	            @endforeach
            </tbody>
        </table>
    </div>
@endsection