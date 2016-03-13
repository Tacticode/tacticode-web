{{--*/ $nav = 'teams' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/form-validator.js"></script>
    <script src="/js/add-team.js"></script>

    <script src="/js/teams.js"></script>
    <script src="/js/visibility.js"></script>
@endsection

@section('content')
    <input id="visibility" type="hidden" value="{{$team->visible}}">
    <input id="team_id" type="hidden" value="{{$team->id}}">

    <h1 class="page-header">
        {{ $team->name }}

        @if ($team->visible)
            <a class="btn btn-success visibility clickable">
                <i class="fa fa-eye"></i> <span>@lang('characters.visible')</span>
            </a>
        @else
            <a class="btn btn-warning visibility clickable">
                <i class="fa fa-eye-slash"></i> <span>@lang('characters.invisible')</span>
            </a>
        @endif
    </h1>

    <div class="row">
        <div class="col-md-4">

            {!! Form::open(['onsubmit' => 'teams.checkSubmit(event)']) !!}

                <div class="form-group has-feedback @if ($errors->has('name')) has-error @endif" id="name-group">
                    {!! Form::label('name', trans('teams.name')) !!}
                    {!! Form::text('name', $team->name, ['class' => 'form-control', 'required' => 'required']) !!}
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

                <div class="characters">
                    @foreach ($team->character as $key => $character)
                        <div class="form-group" rel="{{$key + 1}}">
                            {!! Form::label(trans('teams.character') . ($key + 1), 'Character ' . ($key + 1)) !!}
                            - <a onclick="teams.removeCharacter({{ $key + 1}})" class="clickable red">@lang('teams.removeCharacter')</a>
                            {!! Form::select('character' . ($key + 1), $characters, $character->id, ['class' => 'form-control', 'name' => 'characters[' . ($key + 1) .']']) !!}
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <button class="btn btn-success" onclick="teams.addCharacter()" type="button">+ @lang('teams.addCharacter')</button>
                </div>

                <div class="form-group">
                    {!! Form::submit(trans('navigation.update'), ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection