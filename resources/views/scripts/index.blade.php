{{--*/ $nav = 'scripts' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Scripts</h1>

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
                <tr>
                    <td>Script1</td>
                    <td>10</td>
                    <td>
                        <a href="/scripts/1" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>Script2</td>
                    <td>20</td>
                    <td>
                        <a href="/scripts/2" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>Rush</td>
                    <td>42</td>
                    <td>
                        <a href="/scripts/3" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection