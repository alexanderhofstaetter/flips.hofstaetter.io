@extends('layouts.frontend')

@section('maincontent')

<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('/media/photos/photo12@2x.jpg');">
        <div class="row no-gutters bg-black-50">
            <!-- Main Section -->
            <div class="hero-static col-md-6 d-flex align-items-center bg-white">
                <div class="p-3 w-100">

                    <div class="alert alert-warning text-center" role="alert">
                        <p class="mb-0">Aktuell ist keine Registrierung möglich. Persönlicher Invite only!</strong></p>
                    </div>

                    <!-- Header -->
                    <div class="mb-3 text-center">
                        <a class="link-fx text-success font-w700 font-size-h1" href="/">
                            <span class="text-dark">{{ config('app.name') }}</span>
                            <span class="text-success"> - {{ config('app.desc') }}</span>
                        </a>
                        <p class="text-uppercase font-w700 font-size-sm text-muted">Registrieren</p>
                    </div>
                    <!-- END Header -->

                    <!-- Reminder Form -->
                    <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.js) -->
                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <div class="row no-gutters justify-content-center">
                        <div class="col-sm-8 col-xl-6">
                            <form class="js-validation-reminder" method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control-lg form-control-alt form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Adresse" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control-lg form-control-alt form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Passwort" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                        <input id="password-confirm" type="password" class="form-control-lg form-control-alt form-control" name="password_confirmation" placeholder="Passwort bestätigen" required>
                                </div>

                                <div class="form-group text-center py-3">
                                    <button type="submit" class="btn btn-block btn-hero-lg btn-hero-success">
                                        <i class="fa fa-fw fa-plus mr-1"></i> Registrieren
                                    </button>
                                    <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                        <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('password.request') }}">
                                            <i class="fa fa-exclamation-triangle text-muted mr-1"></i> Passwort vergessen
                                        </a>
                                        <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('login') }}">
                                            <i class="fa fa-sign-in-alt text-muted mr-1"></i> Login
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
                    <p class="display-4 font-w700 text-white mb-3">
                        Welcome to the future
                    </p>
                    <p class="font-size-lg font-w600 text-white-75 mb-0">
                        {{ config('app.name') }} - {{ config('app.desc') }}
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