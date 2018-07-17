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
                        <p class="text-uppercase font-w700 font-size-sm text-muted">Passwort vergessen</p>
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

                            <form class="js-validation-reminder" method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group py-3">

                                    <input id="email" type="email" class="form-control form-control-lg form-control-alt form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  placeholder="E-Mail Adresse" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
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

<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Reset Password</div>

                <div class="card-body">
                   

                    
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
