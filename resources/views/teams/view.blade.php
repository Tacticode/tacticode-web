{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">{{ $team->name }}</h1>

    <div class="row">
        <div class="col-md-4">

            {!! Form::open() !!}

                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', $team->name, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('name') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

    <h2 class="sub-header">Characters</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($characters as $character)
                    <tr>
                        <td>{{$character->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection