@extends('layouts.backend')

@section('maincontent')

<!-- Lehrveranstaltungen -->
<h1>Aktuelle und aktive Lehrveranstaltungen</h1>

<form class="mb-4" action="{{ route('user.wulearn.load.data', $user->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-primary">
        <i class="fas fa-sync-alt"></i> Daten aktualisieren
    </button>
</form>

<p>Es konnten {{ $user->lvs()->count() }} aktive Lehrveranstaltungen gefunden werden.</p>

@foreach ($user->lvs()->orderBy('gradebook', 'desc')->get() as $key => $lv)
<div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
        <h4 class="block-title">
            <strong>{{ $lv->key }} {{ $lv->name }}</strong>
            @if ($lv->gradebook)
            <span class="badge badge-pill badge-dark">{{ $lv->grades()->count() }} Noten</span>
            @endif
            <small>({{ $lv->SemesterText }})</small>
        </h4>
        @if ($lv->gradebook)
        <button class="btn btn-outline-secondary btn-sm float-right" type="button" data-toggle="collapse" data-target=".gradebook_{{ $key }}" aria-expanded="true">
            <i class="fas fa-toggle-off"></i> Noten
        </button>
        @endif
    </div>
    <div class="block-content">
        @if ($lv->gradebook)
            Aktuell sind {{ $lv->grades()->count() }} Noten eingetragen. <a href="{{ route('user.wulearn.open', [$user->id, urlencode(urlencode($lv->url_gradebook))]) }}" target="_blank">Notenbuch in Learn@WU öffnen</a>.

            <div class="collapse gradebook_{{ $key }}">
                <table class="lv-entry table table-sm table-bordered mt-2">
                    <thead class="font-w700 text-primary">
                        <tr>
                            <th>Bezeichnung</th>
                            <th>Punkte</th> 
                            <th>Datum</th>
                            <th>Eingetragen von</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($lv->grades()->orderBy('entry_date', 'desc')->get() as $grade)
                    <tr class="{{ isset($grade->points_sum) ? "" : "text-muted" }}">
                        <td style="width: 45%;">{{ $grade->title }}</td>
                        <td class="font-w700">
                            @if (isset($grade->points_sum))
                                {{ ($grade->points_sum) }} von {{ $grade->points_max }}
                            @else
                                - (von {{ $grade->points_max }})
                            @endif
                        </td>
                        <td>{{ $grade->entry_date }}</td>
                        <td>{{ $grade->teacher_name }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <p class="font-w700 text-success">
                    Gesamtpunkte: {{ array_sum(array_column($lv->grades()->get()->toArray(), 'points_sum')) }} von {{ array_sum(array_column($lv->grades()->get()->toArray(), 'points_max')) }}
                </p>
            </div>
        @else
            <p>Kein Notenbuch vorhanden. <a href="{{ route('user.wulearn.open', [$user->id, urlencode(urlencode($lv->url))]) }}" target="_blank">LV in Learn@WU öffnen</a>.</p>
        @endif
    </div>
</div>
@endforeach
<!-- END Lehrveranstaltungen und Noten -->

@endsection