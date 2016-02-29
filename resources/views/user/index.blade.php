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
    
            {!! Form::open() !!}

                <div class="form-group has-feedback @if ($errors->has('login')) has-error @endif" id="login-group">
                    {!! Form::label('login', trans('users.login')) !!}
                    {!! Form::text('login', Auth::user()->login, ['class' => 'form-control']) !!}
                    <span class="help-block" id="login-error">
                        @if ($errors->has('login'))
                            {{$errors->first('login')}}
                        @endif
                    </span>
                    <span id="login-icon" class="fa form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback @if ($errors->has('email')) has-error @endif" id="email-group">
                    {!! Form::label('email', trans('users.email')) !!}
                    {!! Form::email('email', Auth::user()->email, ['class' => 'form-control']) !!}
                    <span class="help-block" id="email-error">
                        @if ($errors->has('email'))
                            {{$errors->first('email')}}
                        @endif
                    </span>
                    <span id="email-icon" class="fa form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                    {!! Form::submit(trans('navigation.update'), ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

    <h2 class="sub-header">@lang('users.updatePassword')</h2>

    <div class="row">
        <div class="col-md-4">

            {!! Form::open(['url' => '/changepassword']) !!}

                <div class="form-group">
                    {!! Form::label('password', trans('users.password')) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    <span class="help-block" id="password-error">
                        @if ($errors->has('password'))
                            {{$errors->first('password')}}
                        @endif
                    </span>
                    <span id="password-icon" class="fa form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                    {!! Form::label('new-password', trans('users.newPassword')) !!}
                    {!! Form::password('new-password', ['class' => 'form-control']) !!}
                    <span class="help-block" id="new-password-error">
                        @if ($errors->has('new-password'))
                            {{$errors->first('new-password')}}
                        @endif
                    </span>
                    <span id="new-password-icon" class="fa form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                    {!! Form::label('new-password_confirmation', trans('users.confirmNewPassword')) !!}
                    {!! Form::password('new-password_confirmation', ['class' => 'form-control']) !!}
                    <span class="help-block" id="new-password_confirmation-error">
                        @if ($errors->has('new-password_confirmation'))
                            {{$errors->first('new-password_confirmation')}}
                        @endif
                    </span>
                    <span id="new-password_confirmation-icon" class="fa form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                    {!! Form::submit(trans('navigation.update'), ['class' => 'btn btn-danger form-control']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>
        
@endsection