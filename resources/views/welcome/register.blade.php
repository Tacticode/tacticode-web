@extends('layouts.home')

@section('page-scripts')
    <script src="/js/form-validator.js"></script>
    <script src="/js/register.js"></script>
@endsection

@section('jumbotron')
    <div class="container">
        <h1>@lang('users.registration')</h1>
        <p>@lang('welcome.registration')</p>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(['url' => '/register']) !!}
                
                <div class="form-group has-feedback @if ($errors->has('login')) has-error @elseif (isset($fields['login'])) has-success @endif" id="login-group">
                    {!! Form::label('login', trans('users.login')) !!}
                    <input type="text" class="form-control" id="login" name="login" placeholder="@lang('users.login')" data-placement="right" @if (isset($fields['login'])) value="{{$fields['login']}}" @endif>
                    <span class="help-block" id="login-error">
                        @if ($errors->has('login'))
                            {{$errors->first('login')}}
                        @endif
                    </span>
                    <span id="login-icon" class="fa @if ($errors->has('login')) fa-close @elseif (isset($fields['login'])) fa-check @endif form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback @if ($errors->has('email')) has-error @elseif (isset($fields['email'])) has-success @endif" id="email-group">
                    {!! Form::label('login', trans('users.email')) !!}
                    <input type="email" class="form-control" id="email" name="email" placeholder="@lang('users.email')" data-placement="right" @if (isset($fields['email'])) value="{{$fields['email']}}" @endif>
                    <span class="help-block" id="email-error">
                        @if ($errors->has('email'))
                            {{$errors->first('email')}}
                        @endif
                    </span>
                    <span id="email-icon" class="fa @if ($errors->has('email')) fa-close @elseif (isset($fields['email'])) fa-check @endif form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback @if ($errors->has('password')) has-error @endif" id="password-group">
                    {!! Form::label('login', trans('users.password')) !!}
                    <input type="password" class="form-control" id="password" name="password" placeholder="@lang('users.password')" data-placement="right">
                    <span class="help-block" id="password-error">
                        @if ($errors->has('password'))
                            {{$errors->first('password')}}
                        @endif
                    </span>
                    <span id="password-icon" class="fa form-control-feedback" aria-hidden="true"></span>
                </div>
                <p class="help-block">@lang('users.terms', ['link' => '/terms'])</p>
                <button type="submit" class="btn btn-primary">Register</button>
            
            {!! Form::close() !!}
        </div>
    </div>
@endsection