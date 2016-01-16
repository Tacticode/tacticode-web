{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">$character->name</h1>

    <div class="row">
        <div class="col-md-4">

            {!! Form::open() !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', $character->name, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('class', 'Class') !!}
                    {!! Form::select('class', $classes, $character->class_id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('script', 'Script') !!}
                    {!! Form::select('script', $scripts, $character->script_id, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

    <h2 class="sub-header">Fighting history</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Enemy</th>
                    <th>Victory</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2015-06-27 18:28</td>
                    <td><a href="/characters/view/1">Kevin-roxXxor</a></td>
                    <td class="success"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></td>
                </tr>
                <tr>
                    <td>2015-06-26 15:32</td>
                    <td><a href="/characters/view/1">Archer42b</a></td>
                    <td class="danger"><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></td>
                </tr>
                <tr>
                    <td>2015-06-25 12:42</td>
                    <td><a href="/characters/view/1">NoobXxD3ad</a></td>
                    <td class="danger"><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection