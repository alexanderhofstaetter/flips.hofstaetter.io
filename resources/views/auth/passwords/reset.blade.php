@extends('layouts.frontend')

@section('maincontent')

<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('/media/photos/photo19@2x.jpg');">
        <div class="row no-gutters bg-gd-sun-op">
            <!-- Main Section -->
            <div class="hero-static col-md-6 d-flex align-items-center bg-white">
                <div class="p-3 w-100">
                    <!-- Header -->
                    <div class="text-center">
                        <a class="link-fx text-warning font-w700 font-size-h1" href="/">
                            <span class="text-dark">{{ config('app.name') }}</span>
                            <span class="text-warning"> - {{ config('app.desc') }}</span>
                        </a>
                        <p class="text-uppercase font-w700 font-size-sm text-muted">Passwort zurücksetzen</p>
                    </div>
                    <!-- END Header -->

                    <!-- Reminder Form -->
                    <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.js) -->
                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <div class="row no-gutters justify-content-center">
                        <div class="col-sm-8 col-xl-6">
                            
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.request') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">

                                     <input id="email" type="email" class="form-control-lg form-control-alt form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Adresse" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group">

                                     <input id="password" type="password" class="form-control-lg form-control-alt form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Neues Passwort" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group">

                                     <input id="password-confirm" type="password" class="form-control-lg form-control-alt form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Neues Passwort bestätigen" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-block btn-hero-lg btn-hero-warning">
                                        <i class="fa fa-fw fa-reply mr-1"></i> Passwort zurücksetzen
                                    </button>
                                    <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                        <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('login') }}">
                                            <i class="fa fa-sign-in-alt text-muted mr-1"></i> Login
                                        </a>
                                        <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('register') }}">
                                            <i class="fa fa-plus text-muted mr-1"></i> Registrieren
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Reminder Form -->
                </div>
            </div>
            <!-- END Main Section -->

            <!-- Meta Info Section -->
            <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                <div class="p-3">
                    <p class="display-4 font-w700 text-white mb-0">
                        Don’t worry of failure..
                    </p>
                    <p class="font-size-h1 font-w600 text-white-75 mb-0">
                        ..but learn from it!
                    </p>
                </div>
            </div>
            <!-- END Meta Info Section -->
        </div>
    </div>
    <!-- END Page Content -->

</main>
<!-- END Main Container -->

@endsection