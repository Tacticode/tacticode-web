@extends('layouts.home')

@section('jumbotron')
    <div class="container">
        <h1>@lang('users.resetPassword')</h1>
        <p>@lang('welcome.resetPassword')</p>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            {!! Form::open(['url' => '/password/reset']) !!}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    {!! Form::label('email', trans('users.email')) !!}
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    {!! Form::label('password', trans('users.newPassword')) !!}
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    {!! Form::label('confirm_password', trans('users.confirmNewPassword')) !!}
                    <input type="password" class="form-control" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary">Reset Password</button>

            {!! Form::close() !!}
        </div>
    </div>
@endsection