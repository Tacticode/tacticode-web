{{--*/ $nav = 'user' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/form-validator.js"></script>
    <script src="/js/user-update.js"></script>
@endsection

@section('content')
    <h1 class="page-header">{{ucfirst(Auth::user()->login)}}</h1>

    <div class="row">
        <div class="col-md-4">
    
            {!! Form::open(['url' => '/user']) !!}

                <div class="form-group has-feedback @if ($errors->has('login')) has-error @endif" id="login-group">
                    {!! Form::label('login', 'Login :') !!}
                    {!! Form::text('login', Auth::user()->login, ['class' => 'form-control']) !!}
                    <span class="help-block" id="login-error">
                        @if ($errors->has('login'))
                            {{$errors->first('login')}}
                        @endif
                    </span>
                    <span id="login-icon" class="fa form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
                    {!! Form::label('email', 'Email :') !!}
                    {!! Form::email('email', Auth::user()->email, ['class' => 'form-control']) !!}
                    <span class="help-block" id="email-error">
                        @if ($errors->has('email'))
                            {{$errors->first('email')}}
                        @endif
                    </span>
                    <span id="email-icon" class="fa form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

    <h2 class="sub-header">Update password</h2>

    <div class="row">
        <div class="col-md-4">

            {!! Form::open(['url' => '/user']) !!}

                <div class="form-group">
                    {!! Form::label('password', 'Password :') !!}
                    {!! Form::text('password', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('new-password', 'New password :') !!}
                    {!! Form::text('new-password', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('confirm-new-password', 'Confirm new password :') !!}
                    {!! Form::text('confirm-new-password', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-danger form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>
        
@endsection