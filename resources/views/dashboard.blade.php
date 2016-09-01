{{--*/ $nav = 'dashboard' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('dashboard.title')</h1>

    <div class="row placeholders">
        @if (count($user->character))
            @foreach ($user->character as $character)
                <div class="col-xs-6 col-sm-3 placeholder">
                    <div>
                        @include('partials.raceimg', ['race' => $character->race->name])
                    </div>
                    <h4>{{ $character->name }}</h4>
                    <span class="text-muted"><a href="/characters/{{ $character->id }}">@lang('navigation.seeMore')</a></span>
                </div>
            @endforeach
        @else
            <div class="col-xs-12">
                <i>@lang('dashboard.noCharacters')</i>
            </div>
        @endif
    </div>

    <h2 class="sub-header">@lang('fights.history')</h2>
    <div class="table-responsive">
        @if (count($fights))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>@lang('fights.date')</th>
                        <th>@lang('fights.type')</th>
                        <th>@lang('fights.character')</th>
                        <th>@lang('fights.enemy')</th>
                        <th>@lang('fights.victory')</th>
                        <th>@lang('fights.points')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fights as $fight)
                        <tr>
                            <td><a href="/arena/viewfight/{{$fight->id}}">{{$fight->created_at->format('d M Y - H:i:s')}}</a></td>
                            @if (count($fight->team))
                                <td>Team</td>
                                @if (in_array($fight->team[0]->id, $teamsIds))
                                    <td><a href="/teams/{{$fight->team[0]->id}}">{{$fight->team[0]->name}}</a></td>
                                    <td><a href="/teams/{{$fight->team[1]->id}}">{{$fight->team[1]->name}}</a></td>
                                @else
                                    <td><a href="/teams/{{$fight->team[1]->id}}">{{$fight->team[1]->name}}</a></td>
                                    <td><a href="/teams/{{$fight->team[0]->id}}">{{$fight->team[0]->name}}</a></td>
                                @endif
                            @else
                                <td>Solo</td>
                                @if (in_array($fight->character[0]->id, $charactersIds))
                                    <td><a href="/characters/{{$fight->character[0]->id}}">{{$fight->character[0]->name}}</a></td>
                                    <td><a href="/characters/{{$fight->character[1]->id}}">{{$fight->character[1]->name}}</a></td>
                                @else
                                    <td><a href="/characters/{{$fight->character[1]->id}}">{{$fight->character[1]->name}}</a></td>
                                    <td><a href="/characters/{{$fight->character[0]->id}}">{{$fight->character[0]->name}}</a></td>
                                @endif
                            @endif
                            @if ($fight->result !== null)
                                @if ($fight->result == 0)
                                    <td class="warning"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span></td>
                                @elseif ((count($fight->team) && in_array($fight->result, $teamsIds)) ||
                                         (!count($fight->team) && in_array($fight->result, $charactersIds)))
                                    <td class="success"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></td>
                                @else
                                    <td class="danger"><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></td>
                                @endif
                            @else
                                <td>@lang('arena.stillComputing')</span></td>
                            @endif
                            @if ($fight->result === null)
                                <td>
                                    -
                                </td>
                            @else
                                <td class="{{ $fight->elo_change > 0 ? 'success' : 'danger' }}">
                                    {{ ($fight->elo_change > 0 ? '+' : '').$fight->elo_change }} ({{ $fight->elo_result }})
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <i>@lang('arena.noFights')</i>
        @endif
    </div>
@endsection