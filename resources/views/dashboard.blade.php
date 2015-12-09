{{--*/ $nav = 'dashboard' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Dashboard</h1>

    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <h4>Character 1</h4>
            <span class="text-muted"><a href="#">See more</a></span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <h4>Character 2</h4>
            <span class="text-muted"><a href="#">See more</a></span>
        </div>
    </div>

    <h2 class="sub-header">Fighting history</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Character</th>
                    <th>Enemy</th>
                    <th>Victory</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2015-06-27 18:28</td>
                    <td>Character 1</td>
                    <td>Bob</td>
                    <td><span class="glyphicon glyphicon-check" aria-hidden="true"></span></td>
                </tr>
                <tr>
                    <td>2015-06-26 15:32</td>
                    <td>Character 2</td>
                    <td>Patrick</td>
                    <td><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></td>
                </tr>
                <tr>
                    <td>2015-06-25 12:42</td>
                    <td>Character 1</td>
                    <td>Sebastien</td>
                    <td><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection