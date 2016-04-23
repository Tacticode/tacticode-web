{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/visibility.js"></script>
@endsection

@section('content')

    <h1 class="page-header">
        <input class="visibility" type="hidden" value="{{$character->visible}}">
        <input class="character_id" type="hidden" value="{{$character->id}}">

        {{ $character->name }}
        
        <a class="btn btn-primary" href="/characters/{{$character->id}}/powers">@lang('powers.manage')</a>
        @if ($character->visible)
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

            {!! Form::open() !!}

                {!! Form::hidden('race', $character->race_id) !!}

                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', trans('characters.name')) !!}
                    {!! Form::text('name', $character->name, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('name') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group @if ($errors->has('race')) has-error @endif">
                    {!! Form::label('race', trans('characters.race')) !!}
                    {!! Form::select('race', $races, $character->race_id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('race') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group @if ($errors->has('script')) has-error @endif">
                    {!! Form::label('script', trans('characters.script')) !!}
                    {!! Form::select('script', $scripts, $character->script_id, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('script') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::submit(trans('navigation.update'), ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

    <h2 class="sub-header">@lang('fights.history')</h2>
    <div class="table-responsive">
        @if (count($character->fight))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>@lang('fights.date')</th>
                        <th>@lang('fights.enemy')</th>
                        <th>@lang('fights.victory')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($character->fight as $fight)
                        @if (!$fight->character[0]['team_id'])
                            <tr>
                                <td>{{$fight->created_at->format('d M Y - H:i:s')}}</td>
                                <td>
                                    @if ($fight->character[0]['id'] == $character->id)
                                        <a href="/characters/view/{{$fight->character[1]['id']}}">{{$fight->character[1]['name']}}</a>
                                    @else
                                        <a href="/characters/view/{{$fight->character[0]['id']}}">{{$fight->character[0]['name']}}</a>
                                    @endif
                                </td>
                                @if ($fight->result == $character->id)
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
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @else
            <i>@lang('characters.noFights')</i>
        @endif
    </div>
@endsection