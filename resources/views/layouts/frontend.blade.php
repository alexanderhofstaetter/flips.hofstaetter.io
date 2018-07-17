@extends('layouts.app')

@section('content')
    
    <!-- Page Container -->
    <div id="page-container">
        
        <!-- Main Container -->
        <main id="main-container">
            
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @include('flash::message')
                    </div>
                </div>
            </div>

            @yield('maincontent')
            
        </main>
        <!-- END Main Container -->

    </div>
    <!-- END Page Container -->

@endsection