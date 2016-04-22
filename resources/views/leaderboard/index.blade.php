{{--*/ $nav = 'leaderboard' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('leaderboard.title')</h1>

    <ul class="nav nav-pills">
      <li class="active"><a data-toggle="pill" href="#global">Global</a></li>
      <li><a data-toggle="pill" href="#solo">Solo</a></li>
      <li><a data-toggle="pill" href="#team">Team</a></li>
    </ul>

    <div class="tab-content">
        <div id="global" class="table-responsive tab-pane fade in active">
            @include('leaderboard.table_content', ['users' => $users, 'elo' => $elo['global']])
        </div>

        <div id="solo" class="table-responsive tab-pane fade">
            @include('leaderboard.table_content', ['users' => $users, 'elo' => $elo['solo']])
        </div>

        <div id="team" class="table-responsive tab-pane fade">
            @include('leaderboard.table_content', ['users' => $users, 'elo' => $elo['team']])
        </div>
    </div>
@endsection