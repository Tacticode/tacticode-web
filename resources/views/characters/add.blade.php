{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('characters.add')</h1>

    <div class="row">
        <div class="col-md-4">

            {!! Form::open() !!}

                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', trans('characters.name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('name') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group @if ($errors->has('race')) has-error @endif">
                    {!! Form::label('race', trans('characters.race')) !!}
                    {!! Form::select('race', $races, null, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('race') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group @if ($errors->has('script')) has-error @endif">
                    {!! Form::label('script', trans('characters.script')) !!}
                    {!! Form::select('script', $scripts, null, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('script') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::submit(trans('navigation.add'), ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection