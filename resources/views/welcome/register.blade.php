@extends('layouts.home')

@section('page-scripts')
    <script src="/js/register.js"></script>
@endsection

@section('jumbotron')
    <div class="container">
        <h1>Registration</h1>
        <p>You're about to experience something amazing</p>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="/register">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <div class="form-group has-feedback @if (isset($formError['login'])) has-error @elseif (isset($fields['login'])) has-success @endif" id="login-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Login" data-placement="right" @if (isset($fields['login'])) value="{{$fields['login']}}" @endif>
                    <span class="help-block" id="login-error">
                        @if (isset($formError['login']))
                            {{$formError['login']}}
                        @endif
                    </span>
                    <span id="login-icon" class="fa @if (isset($formError['login'])) fa-close @elseif (isset($fields['login'])) fa-check @endif form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback @if (isset($formError['email'])) has-error @elseif (isset($fields['email'])) has-success @endif" id="email-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-placement="right" @if (isset($fields['email'])) value="{{$fields['email']}}" @endif>
                    <span class="help-block" id="email-error">
                        @if (isset($formError['email']))
                            {{$formError['email']}}
                        @endif
                    </span>
                    <span id="email-icon" class="fa @if (isset($formError['email'])) fa-close @elseif (isset($fields['email'])) fa-check @endif form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback @if (isset($formError['password'])) has-error @endif" id="password-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" data-placement="right">
                    <span class="help-block" id="password-error">
                        @if (isset($formError['password']))
                            {{$formError['password']}}
                        @endif
                    </span>
                    <span id="password-icon" class="fa form-control-feedback" aria-hidden="true"></span>
                </div>
                <p class="help-block">By clicking on the register button, you accept the <a href="/terms" target="_blank">terms of use</a>.</p>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
@endsection