@extends('layouts.backend')

@section('maincontent')

<!-- Prüfungseinsicht -->
<h1>Prüfungseinsicht</h1>

<form class="mb-4" action="{{ route('user.wulearn.load.exams', $user->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-primary">
        <i class="fas fa-sync-alt"></i> Daten aktualisieren
    </button>
</form>

<p>Aktuell sind {{ $user->exams()->count() }} Prüfungen zur Einsicht verfügbar.</p>

@foreach ($user->exams()->orderBy('date', 'desc')->get() as $exam)
<div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
        <h4 class="font-w700 block-title">Prüfung: {{ $exam->title }}</h4>
        <small>({{ $exam->date->diffForHumans() }})</small>
    </div>
    <div class="block-content mb-3">    
        Ein Ergebnis der Prüfung vom {{ $exam->date->format('d.m.Y') }} liegt vor. 
            
        <a href="/download/{{ $exam->file }}">
            Download PDF 
            <i class="fa fa-file-download"></i>
        </a>   
    </div>
</div>
@endforeach
<!-- END Prüfungseinsicht -->

@endsection