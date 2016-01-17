{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Characters</h1>

    @if (Auth::user()->character)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Script</th>
                        <th>Battles</th>
                        <th>Victories</th>
                        <th>Defeats</th>
                        <th>Draws</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->character as $character)
                        <tr>
                            <td>{{ $character->name }}</td>
                            <td>{{ $character->classe()->first()->name }}</td>
                            <td>
                                @if ($script = $character->script()->first())
                                    {{ $script->name }}
                                @else
                                    <i>No script associated</i>
                                @endif
                            </td>
                            <td>10</td>
                            <td class="success">8</td>
                            <td class="danger">2</td>
                            <td class="warning">0</td>
                            <td>
                                <a href="/characters/{{ $character->id }}" class="btn btn-primary">More</a>
                                <a class="btn btn-danger" href="/characters/delete/{{ $character->id }}" onclick="if (!confirm('Are you sure you want to delete this character ?')) return false">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <i>You have no characters at this time. Do you want to <a href="/characters/add">add one</a>?</a>
        </div>
    @endif

    <div class="row">
        <a class="btn btn-success" href="/characters/add">Add a character</a>
    </div>
@endsection