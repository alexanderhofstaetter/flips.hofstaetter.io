@extends('layouts.backend')

@section('maincontent')

<!-- Noten -->
<h1>Noten aller Lehrveranstaltungen</h1>

<form class="mb-4" action="{{ route('user.wulearn.load.data', $user->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-primary">
        <i class="fas fa-sync-alt"></i> Daten aktualisieren
    </button>
</form>

<p>Aktuell sind {{ $user->grades()->count() }} Noten eingetragen.</p>

<table class="table table-striped table-sm table-bordered">
    <thead class="font-w700 text-primary">
        <tr>
            <th>Bezeichnung</th>
            <th>Punkte</th> 
            <th>Datum</th>
            <th>Eingetragen von</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($user->grades()->orderBy('entry_date', 'desc')->whereNotNull('entry_date')->get() as $grade)
    <tr class="{{ isset($grade->points_sum) ? "" : "text-muted" }}">
        <td>
            <span class="font-w700">{{ $grade->lv->name }}</span> | {{ $grade->title }}
            @if (isset($grade->comments))
                <br/>
                <a href="#" class="text-primary" data-toggle="tooltip" data-placement="top" title="{{ ($grade->comments) }}">
                    Kommentar <i class="fas fa-info"></i>
                </a>
            @endif
        </td>
        <td class="font-w700">
            @if (isset($grade->points_sum))
                {{ ($grade->points_sum) }} von {{ $grade->points_max }}
            @else
                - (von {{ $grade->points_max }})
            @endif
        </td>
        <td>{{ $grade->entry_date->diffForHumans() }}</td>
        <td>{{ $grade->teacher_name }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
<!-- END Noten -->

@endsection