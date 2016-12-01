<h2 class="sub-header">
    @lang('fights.history')

    @if ($full)
     ({{$character->elo}} elo)
    @endif
</h2>

<div class="table-responsive">
    @if (count($character->fight))
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
                @foreach ($character->fight as $fight)
                    @if (!$fight->character[0]['team_id'])
                        <tr>
                            <td><a href="/arena/viewfight/{{$fight->id}}">{{$fight->created_at->format('d M Y - H:i:s')}}</a></td>
                            <td>
                                @if (count($fight->character) <= 1)
                                    UNKNOWN
                                @elseif ($fight->character[0]['id'] == $character->id)
                                    <a href="/characters/{{$fight->character[1]['id']}}">{{$fight->character[1]['name']}}</a>
                                @else
                                    <a href="/characters/{{$fight->character[0]['id']}}">{{$fight->character[0]['name']}}</a>
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
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <i>@lang('characters.noFights')</i>
    @endif
</div>