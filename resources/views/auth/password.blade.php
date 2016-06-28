@extends('layouts.home')

@section('jumbotron')
    <div class="container">
        <h1>@lang('users.forgotPassword')</h1>
        <p>@lang('welcome.forgotPassword')</p>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            {!! Form::open(['url' => '/password/email']) !!}

                <div class="form-group">
                    {!! Form::label('email', trans('users.email')) !!}
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                <button type="submit" class="btn btn-primary">Send link</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection