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
            	@foreach ($elo as $key => $e)
            	 	@if ($users[$key-1]->id == Auth::user()->id)
            	 		<tr class="info">
		                    <td>{{ array_search($key, array_keys($elo)) + 1 }}</td>
		                    <td>{{ $users[$key-1]->login }}</td>
		                    <td>{{ $e }}</td>
		                    <td><a class="btn btn-primary" href="/user">@lang('leaderboard.myProfile')</a></td>
		                </tr>
            	 	@else
		                <tr>
		                    <td>{{ array_search($key, array_keys($elo)) + 1 }}</td>
		                    <td>{{ $users[$key-1]->login }}</td>
		                    <td>{{ $e }}</td>
		                    <td><a class="btn btn-primary" href="/users/{{ $users[$key-1]->id }}">@lang('navigation.view')</a></td>
		                </tr>
	                @endif
	            @endforeach
            </tbody>
        </table>
    </div>
@endsection