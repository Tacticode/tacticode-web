{{--*/ $nav = 'leaderboard' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Leaderboard</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
            	@foreach ($users as $user)
            	 	@if ($user->id == Auth::user()->id)
            	 		<tr class="info">
		                    <td>?</td>
		                    <td>{{ $user->login }}</td>
		                    <td>?</td>
		                    <td><a class="btn btn-primary" href="/user">My profile</a></td>
		                </tr>
            	 	@else
		                <tr>
		                    <td>?</td>
		                    <td>{{ $user->login }}</td>
		                    <td>?</td>
		                    <td><a class="btn btn-primary" href="/users/{{ $user->id }}">View</a></td>
		                </tr>
	                @endif
	            @endforeach
            </tbody>
        </table>
    </div>
@endsection