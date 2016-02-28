{{--*/ $nav = 'teams' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Teams <a class="btn btn-primary" href="/characters">Manage characters</a></h1>

    @if (count($teams))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Number of characters</th>
                        <th>Battles</th>
                        <th>Victories</th>
                        <th>Defeats</th>
                        <th>Draws</th>
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
                                <a href="/teams/{{ $team->id }}" class="btn btn-primary">More</a>
                                <a class="btn btn-danger" href="/teams/delete/{{ $team->id }}" onclick="if (!confirm('Are you sure you want to delete this team ?')) return false">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <i>You have no team at this time. Do you want to <a href="/teams/add">add one</a>?</a>
        </div>
    @endif

    <div class="row">
        <a class="btn btn-success" href="/teams/add">Add a team</a>
    </div>
@endsection