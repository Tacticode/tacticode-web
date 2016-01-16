{{--*/ $nav = 'scripts' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Scripts</h1>

    @if (Auth::user()->script)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Lines</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->script as $script)
                        <tr>
                            <td>{{ $script->name }}</td>
                            <td>1</td>
                            <td>
                                <a href="/scripts/{{ $script->id }}" class="btn btn-primary">Edit</a>
                                <a class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <i>You have no scripts at this time. Do you want to <a href="/scripts/add">add one</a>?</a>
        </div>
    @endif

    <div class="row">
        <a class="btn btn-success" href="/scripts/add">Add a script</a>
    </div>
@endsection