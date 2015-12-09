{{--*/ $nav = 'dashboard' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Dashboard</h1>

    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <h4>Bob</h4>
            <span class="text-muted"><a href="/characters/1">See more</a></span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <h4>Warrior1</a></h4>
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
                    <td><a href="/characters/1">Bob</a></td>
                    <td><a href="/characters/1">Kevin-roxXxor</a></td>
                    <td class="success"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></td>
                </tr>
                <tr>
                    <td>2015-06-26 15:32</td>
                    <td><a href="/characters/1">Bob</a></td>
                    <td><a href="/characters/1">Archer42b</a></td>
                    <td class="danger"><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></td>
                </tr>
                <tr>
                    <td>2015-06-25 12:42</td>
                    <td><a href="/characters/2">Warrior1</a></td>
                    <td><a href="/characters/1">NoobXxD3ad</a></td>
                    <td class="danger"><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection