{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Add a team</h1>

    <div class="row">
        <div class="col-md-4">

            {!! Form::open() !!}

                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    <div class="help-block">
                        @foreach ($errors->get('name') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                @for ($i = 0; $i < 5; $i++)
                    <div class="form-group @if ($errors->has('character' . $i)) has-error @endif">
                        {!! Form::label('character' . $i, 'Character ' . ($i + 1)) !!}
                        {!! Form::select('character' . $i, $characters, null, ['class' => 'form-control']) !!}
                        <div class="help-block">
                            @foreach ($errors->get('name') as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endfor

                <div class="form-group">
                    {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection