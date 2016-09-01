{{--*/ $nav = 'teams' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/form-validator.js"></script>
    <script src="/js/add-team.js"></script>

    <script src="/js/teams.js"></script>
    <script src="/js/visibility.js"></script>
@endsection

@section('content')
    <h1 class="page-header">
        <input class="visibility" type="hidden" value="{{$team->visible}}">
        <input class="team_id" type="hidden" value="{{$team->id}}">

        {{ $team->name }}

        @if ($team->visible)
            <a class="btn btn-success visibility clickable" data-toggle="tooltip" data-placement="right" title="@lang('characters.visible')">
                <i class="fa fa-eye"></i>
            </a>
        @else
            <a class="btn btn-warning visibility clickable" data-toggle="tooltip" data-placement="right" title="@lang('characters.invisible')">
                <i class="fa fa-eye-slash"></i>
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

    <h2 class="sub-header">@lang('fights.history')</h2>
    <div class="table-responsive">
        @if (count($team->fight))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>@lang('fights.date')</th>
                        <th>@lang('fights.enemy')</th>
                        <th>@lang('fights.victory')</th>
                        <th>@lang('fights.points')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($team->fight as $fight)
                            <tr>
                                <td>{{$fight->created_at->format('d M Y - H:i:s')}}</td>
                                <td>
                                    @if ($fight->team[0]['id'] == $team->id)
                                        <a href="/teams/view/{{$fight->team[1]['id']}}">{{$fight->team[1]['name']}}</a>
                                    @else
                                        <a href="/teams/view/{{$fight->team[0]['id']}}">{{$fight->team[0]['name']}}</a>
                                    @endif
                                </td>
                                @if ($fight->result == $team->id)
                                    <td class="success">
                                        <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                    </td>
                                @elseif ($fight->result === null)
                                    <td>
                                        @lang('arena.stillComputing')
                                    </td>
                                @elseif ($fight->result == 0)
                                    <td class="warning">
                                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                                    </td>
                                @else
                                    <td class="danger">
                                        <span class="glyphicon glyphicon-unchecked" aria-hidden="true">
                                    </td>
                                @endif
                                @if ($fight->result === null)
                                    <td>
                                        -
                                    </td>
                                @else
                                    <td class="{{ $fight->pivot->elo_change > 0 ? 'success' : 'danger' }}">
                                        {{ ($fight->pivot->elo_change > 0 ? '+' : '').$fight->pivot->elo_change }} ({{ $fight->pivot->elo_result }})
                                    </td>
                                @endif
                            </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <i>@lang('characters.noFights')</i>
        @endif
    </div>
@endsection