@extends('layouts.frontend')

@section('maincontent')

<!-- Hero -->
<div class="bg-image">
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <h1 class="display-4 font-w700 mb-2">
                    <span class="text-primary">{{ config('app.name') }}</span><span class="font-w300"> - {{ config('app.desc') }}</span>
                </h1>
                <h2 class="h3 font-w300 text-muted mb-5 invisible" data-toggle="appear" data-timeout="150">
                    Ein Managment Portal für Studenten der WU Wien mit automatischen Schnittstellen zu LPIS und Learn@WU.
                </h2>
                <p>Mit dieser Webanwendung können u.a. Benachrichtigungen über Noten versendet werden, LV-Anmeldungen pünkltich um 14 Uhr gestartet werden und veraltete Prozesse verbessert werden.</p>
                <span class="m-2 d-inline-block invisible" data-toggle="appear" data-timeout="300">
                    <a class="btn btn-hero-primary" href="/dashboard">
                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Jetzt Starten
                    </a>
                </span>
            </div>
            <small class="mx-auto d-block text-center">
            	<a href="https://hofstaetter.io/impressum" target="_blank"><i class="fas fa-external-link-square-alt" aria-hidden="true"></i> Impressum</a>
            	<a href="https://github.com/alexanderhofstaetter/flips.hofstaetter.io" target="_blank" class="ml-3"><i class="fab fa-github" aria-hidden="true"></i> GitHub</a>
            </small>
        </div>
    </div>
</div>
<!-- END Hero -->

@endsection
