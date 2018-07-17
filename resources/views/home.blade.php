@extends('layouts.frontend')

@section('maincontent')

<!-- Hero -->
<div class="bg-image" style="background-image: url('{{ asset('media/photos/photo15@2x.jpg') }}');">
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <h1 class="display-4 font-w700 mb-2">
                    <span class="text-primary">{{ config('app.name') }}</span><span class="font-w300"> - {{ config('app.desc') }}</span>
                </h1>
                <h2 class="h3 font-w300 text-muted mb-5 invisible" data-toggle="appear" data-timeout="150">
                    Ein Managment Portal für (WU) Studenten.
                </h2>
                <span class="m-2 d-inline-block invisible" data-toggle="appear" data-timeout="300">
                    <a class="btn btn-hero-primary" href="/dashboard">
                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Open App
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

@endsection
