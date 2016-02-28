{{--*/ $nav = 'teams' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/form-validator.js"></script>
    <script src="/js/add-team.js"></script>

    <script src="/js/teams.js"></script>
@endsection

@section('content')
    <h1 class="page-header">Add a team</h1>

    <div class="row">
        <div class="col-md-4">

            {!! Form::open(['onsubmit' => 'teams.checkSubmit(event)']) !!}

                <div class="form-group has-feedback @if ($errors->has('name')) has-error @endif" id="name-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    <div class="help-block" id="name-error">
                        @foreach ($errors->get('name') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    <span id="login-icon" class="fa @if ($errors->has('login')) fa-close @elseif (isset($fields['login'])) fa-check @endif form-control-feedback" aria-hidden="true"></span>
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