<h2 class="sub-header">
    @lang('fights.history')

    @if ($full)
     ({{$team->elo}} elo)
    @endif
</h2>

<div class="table-responsive">
    @if (count($team->fight))
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@lang('fights.date')</th>
                    <th>@lang('fights.enemy')</th>
                    <th>@lang('fights.victory')</th>
                    @if ($full)
                        <th>@lang('fights.points')</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($team->fight as $fight)
                        <tr>
                            <td><a href="/arena/viewfight/{{$fight->id}}">{{$fight->created_at->format('d M Y - H:i:s')}}</a></td>
                            <td>
                                @if (count($fight->team) <= 1)
                                    UNKNWON
                                @elseif ($fight->team[0]['id'] == $team->id)
                                    <a href="/teams/{{$fight->team[1]['id']}}">{{$fight->team[1]['name']}}</a>
                                @else
                                    <a href="/teams/{{$fight->team[0]['id']}}">{{$fight->team[0]['name']}}</a>
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
                            @if ($full)
                                @if ($fight->result === null)
                                    <td>
                                        -
                                    </td>
                                @else
                                    <td class="{{ $fight->pivot->elo_change > 0 ? 'success' : 'danger' }}">
                                        {{ ($fight->pivot->elo_change > 0 ? '+' : '').$fight->pivot->elo_change }} ({{ $fight->pivot->elo_result }})
                                    </td>
                                @endif
                            @endif
                        </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <i>@lang('teams.noFights')</i>
    @endif
</div>