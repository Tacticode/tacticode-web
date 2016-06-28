{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/visibility.js"></script>
@endsection

@section('content')
    <h1 class="page-header">@lang('characters.title') <a class="btn btn-primary" href="/teams">@lang('teams.manage')</a></h1>

    @if (count($characters))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>@lang('characters.name')</th>
                        <th>@lang('characters.race')</th>
                        <th>@lang('characters.script')</th>
                        <th>@lang('characters.battles')</th>
                        <th>@lang('characters.victories')</th>
                        <th>@lang('characters.defeats')</th>
                        <th>@lang('characters.draws')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($characters as $character)
                        <tr>
                            <td>{{ $character->name }}</td>
                            <td>{{ $character->race()->first()->name }}</td>
                            <td>
                                @if ($script = $character->script()->first())
                                    {{ $script->name }}
                                @else
                                    <i>@lang('characters.noScript')</i>
                                @endif
                            </td>
                            <td>{{$character->stats['win'] + $character->stats['loss'] + $character->stats['draw']}}</td>
                            <td class="success">{{$character->stats['win']}}</td>
                            <td class="danger">{{$character->stats['loss']}}</td>
                            <td class="warning">{{$character->stats['draw']}}</td>
                            <td>
                                <input class="visibility" type="hidden" value="{{$character->visible}}">
                                <input class="character_id" type="hidden" value="{{$character->id}}">
                                @if ($character->visible)
                                    <a class="btn btn-success visibility clickable" data-toggle="tooltip" data-placement="top" title="@lang('characters.visible')">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @else
                                    <a class="btn btn-warning visibility clickable"  data-toggle="tooltip" data-placement="top" title="@lang('characters.invisible')">
                                        <i class="fa fa-eye-slash"></i>
                                    </a>
                                @endif
                                <a href="/characters/{{ $character->id }}" class="btn btn-primary">@lang('navigation.more')</a>
                                <a class="btn btn-danger" href="/characters/delete/{{ $character->id }}" onclick="if (!confirm('@lang('characters.confirmDelete')')) return false">@lang('navigation.delete')</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <i>@lang('characters.noCharacters', ['link' => '/characters/add'])</i>
        </div>
    @endif

    <div class="row">
        <a class="btn btn-success" href="/characters/add">@lang('characters.add')</a>
    </div>
@endsection