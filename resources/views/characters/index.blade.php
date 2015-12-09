{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Characters</h1>

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
                <tr>
                    <td>Bob</td>
                    <td>Wizzard</td>
                    <td>Rush</td>
                    <td>10</td>
                    <td class="success">8</td>
                    <td class="danger">2</td>
                    <td class="warning">0</td>
                    <td>
                        <a href="/characters/1" class="btn btn-primary">More</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>Warrior1</td>
                    <td>Warrior</td>
                    <td><i>None</i></td>
                    <td>6</td>
                    <td class="success">1</td>
                    <td class="danger">4</td>
                    <td class="warning">1</td>
                    <td>
                        <a href="/characters/1" class="btn btn-primary">More</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection