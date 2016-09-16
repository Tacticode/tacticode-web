{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/visibility.js"></script>
@endsection

@section('content')

    <h1 class="page-header">
        <input class="visibility" type="hidden" value="{{$character->visible}}">
        <input class="character_id" type="hidden" value="{{$character->id}}">

        {{ $character->name }} ({{ $character->race->name }})
        
        <a class="btn btn-primary" href="/characters/{{$character->id}}/powers">@lang('powers.manage')</a>
        @if ($character->visible)
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

    @include('characters.history', ['character' => $character, 'full' => true])
@endsection