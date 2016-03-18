{{--*/ $nav = 'teams' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/visibility.js"></script>
@endsection

@section('content')
    <h1 class="page-header">@lang('teams.title') <a class="btn btn-primary" href="/characters">@lang('characters.manage')</a></h1>

    @if (count($teams))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>@lang('teams.name')</th>
                        <th>@lang('teams.characters')</th>
                        <th>@lang('teams.battles')</th>
                        <th>@lang('teams.victories')</th>
                        <th>@lang('teams.defeats')</th>
                        <th>@lang('teams.draws')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <td>{{ $team->name }}</td>
                            <td>{{ count($team->character) }}</td>
                            <td>10</td>
                            <td class="success">8</td>
                            <td class="danger">2</td>
                            <td class="warning">0</td>
                            <td>
                                <input class="visibility" type="hidden" value="{{$team->visible}}">
                                <input class="team_id" type="hidden" value="{{$team->id}}">
                                @if ($team->visible)
                                    <a class="btn btn-success visibility clickable">
                                        <i class="fa fa-eye"></i> <span>@lang('characters.visible')</span>
                                    </a>
                                @else
                                    <a class="btn btn-warning visibility clickable">
                                        <i class="fa fa-eye-slash"></i> <span>@lang('characters.invisible')</span>
                                    </a>
                                @endif
                                <a href="/teams/{{ $team->id }}" class="btn btn-primary">@lang('navigation.more')</a>
                                <a class="btn btn-danger" href="/teams/delete/{{ $team->id }}" onclick="if (!confirm('@lang('teams.confirmDelete')')) return false">@lang('navigation.delete')</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <i>@lang('teams.noTeams', ['link' => '/teams/add'])</i>
        </div>
    @endif

    <div class="row">
        <a class="btn btn-success" href="/teams/add">@lang('teams.add')</a>
    </div>
@endsection