@extends('layouts.backend')

@section('maincontent')

<!-- Prüfungseinsicht -->
<div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
        <h4 class="block-title mb-0 float-left">
            Prüfungseinsicht
        </h4>

        <form action="{{ route('user.wulearn.load.exams', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm float-right">
                <i class="fas fa-sync-alt"></i> Daten aktualisieren
            </button>
        </form>
    </div>
    <div class="block-content mb-3">
        @foreach ($user->exams()->orderBy('date', 'desc')->get() as $exam)
            <p>
                <h5>
                    <strong>{{ $exam->title }}</strong>
                    <small>({{ $exam->date->todatestring() }})</small>
                </h5>
                <a href="/download/{{ $exam->file }}">Download</a>
            </p>
        @endforeach
    </div>
</div>
<!-- END Prüfungseinsicht -->

@endsection