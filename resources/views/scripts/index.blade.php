{{--*/ $nav = 'scripts' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('scripts.title')</h1>

    @if (count($scripts))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>@lang('scripts.name')</th>
                        <th>@lang('scripts.lines')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scripts as $script)
                        <tr>
                            <td>{{ $script->name }}</td>
                            <td>1</td>
                            <td>
                                <a href="/scripts/{{ $script->id }}" class="btn btn-primary">@lang('navigation.edit')</a>
                                <a class="btn btn-danger" href="/scripts/delete/{{ $script->id }}" onclick="if (!confirm('@lang('scripts.confirmDelete')')) return false">@lang('navigation.delete')</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <i>@lang('scripts.noScripts', ['link' => '/scripts/add'])</i>
        </div>
    @endif

    <div class="row">
        <a class="btn btn-success" href="/scripts/add">@lang('scripts.add')</a>
    </div>
@endsection