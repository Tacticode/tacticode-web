{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('characters.add')</h1>

    <div class="row">

        {!! Form::open() !!}

            <div class="form-group @if ($errors->has('name')) has-error @endif">
                <div class="col-md-12">
                    {!! Form::label('name', trans('characters.name')) !!}
                </div>
                <div class="col-lg-4 col-md-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('name') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group @if ($errors->has('race')) has-error @endif">
                <div class="col-md-12">
                    {!! Form::label('race', trans('characters.race')) !!}
                </div>
                <div class="col-lg-4 col-md-6 row">
                    {!! Form::select('race', $races, null, ['class' => 'form-control', 'style' => 'display:none']) !!}
                    @foreach ($races as $key => $race)
                        <div class="col-md-3 col-xs-6 choose-class clickable" rel="{{$key}}">
                            <div>
                                @include('partials.raceimg', ['race' => $race])
                            </div>
                            <h4>{{$race}}</h4>
                        </div>
                    @endforeach
                    <div class="help-block">
                        @foreach ($errors->get('race') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group @if ($errors->has('script')) has-error @endif">
                <div class="col-md-12">
                    {!! Form::label('script', trans('characters.script')) !!}
                </div>
                <div class="col-lg-4 col-md-6">
                    {!! Form::select('script', $scripts, null, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('script') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::submit(trans('navigation.add'), ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                </div>
            </div>

        {!! Form::close() !!}

    </div>

    <script>
        $(document).ready(function() {

            function makeActive(elem) {

                $('.choose-class').removeClass('active');
                $(elem).addClass('active');
                $('#race').val($(elem).attr('rel'));                
            }

            $('.choose-class').click(function() {

                makeActive(this);
            });

            makeActive($('.choose-class')[0]);
        });
    </script>
@endsection