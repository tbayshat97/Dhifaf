{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title', 'User Login')

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/login.css') }}">
    <style>
        .login-bg {
            background: linear-gradient(45deg, #212529, #cea74e) !important;
        }

        input:not([type]):focus:not([readonly]),
        input[type=text]:not(.browser-default):focus:not([readonly]),
        input[type=password]:not(.browser-default):focus:not([readonly]),
        input[type=email]:not(.browser-default):focus:not([readonly]),
        input[type=url]:not(.browser-default):focus:not([readonly]),
        input[type=time]:not(.browser-default):focus:not([readonly]),
        input[type=date]:not(.browser-default):focus:not([readonly]),
        input[type=datetime]:not(.browser-default):focus:not([readonly]),
        input[type=datetime-local]:not(.browser-default):focus:not([readonly]),
        input[type=tel]:not(.browser-default):focus:not([readonly]),
        input[type=number]:not(.browser-default):focus:not([readonly]),
        input[type=search]:not(.browser-default):focus:not([readonly]),
        textarea.materialize-textarea:focus:not([readonly]) {
            border-bottom: 1px solid #cea74e;
            box-shadow: 0 1px 0 0 #cea74e;
        }

        input:not([type]):focus:not([readonly])+label,
        input[type=text]:not(.browser-default):focus:not([readonly])+label,
        input[type=password]:not(.browser-default):focus:not([readonly])+label,
        input[type=email]:not(.browser-default):focus:not([readonly])+label,
        input[type=url]:not(.browser-default):focus:not([readonly])+label,
        input[type=time]:not(.browser-default):focus:not([readonly])+label,
        input[type=date]:not(.browser-default):focus:not([readonly])+label,
        input[type=datetime]:not(.browser-default):focus:not([readonly])+label,
        input[type=datetime-local]:not(.browser-default):focus:not([readonly])+label,
        input[type=tel]:not(.browser-default):focus:not([readonly])+label,
        input[type=number]:not(.browser-default):focus:not([readonly])+label,
        input[type=search]:not(.browser-default):focus:not([readonly])+label,
        textarea.materialize-textarea:focus:not([readonly])+label {
            color: #cea74e;
        }

        .input-field .prefix.active {
            color: #cea74e;
        }

        .custom-logo {
            background: black;
            margin-top: 20px;
            width: 100%;
            padding: 20px;
            border-radius: 6px;
        }

    </style>
@endsection

{{-- page content --}}
@section('content')
    <div id="login-page" class="row">

        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            <img src="https://dhifaf-baghdad.com/wp-content/uploads/2018/04/cropped-Dhifaf-Baghdad.com_-1.png"
                class="custom-logo" alt="Dhifaf Baghdad Cosmetics Center" style="background: black;" />
            <form class="login-form" method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <h5 class="ml-4">{{ __('Dhifaf Baghdad Admin Panel') }}</h5>
                        <p class="ml-4">Sign in below:</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">person_outline</i>
                        <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="username"
                            value="{{ old('email') }}" autocomplete="email" autofocus>
                        <label for="email" class="center-align">{{ __('Email/Username') }}</label>
                        @error('email')
                            <small class="red-text ml-7">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">lock_outline</i>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" autocomplete="current-password">
                        <label for="password">{{ __('Password') }}</label>
                        @error('password')
                            <small class="red-text ml-7">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12 ml-2 mt-1">
                        <p>
                            <label>
                                <input type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember Me</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="waves-effect waves-light btn black mb-1 mr-1 col s12">
                            Login
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        {{-- <p class="margin medium-small"><a href="{{ route('register') }}">Register Now!</a></p> --}}
                    </div>
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small">
                            <a href="{{ route('admin.forget.password.get') }}">Lost your password?</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
