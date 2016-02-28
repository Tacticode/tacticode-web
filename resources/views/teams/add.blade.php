{{--*/ $nav = 'teams' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/teams.js"></script>
@endsection

@section('content')
    <h1 class="page-header">Add a team</h1>

    <div class="row">
        <div class="col-md-4">

            {!! Form::open() !!}

                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('name') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                <div id="characters-list" style="display:none">
                    {{ json_encode($characters) }}
                </div>

                <div class="characters"></div>

                <div class="form-group">
                    <button class="btn btn-success" onclick="teams.addCharacter()" type="button">+ Add a character</button>
                </div>

                <div class="form-group">
                    {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection