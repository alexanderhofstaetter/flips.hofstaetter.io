@extends('layouts.backend')

@section('maincontent')

<!-- Lehrveranstaltungen und Noten -->
<div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
        <h4 class="block-title mb-0 float-left">
            Aktuelle Lehrveranstaltungen und Noten
        </h4>

        <button class="btn btn-outline-secondary btn-sm float-right" type="button" data-toggle="collapse" data-target=".gradebook" aria-expanded="true"><i class="fas fa-toggle-off"></i> Anzeige Noten</button>&nbsp;

        <form action="{{ route('user.wulearn.load.data', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm float-right">
                <i class="fas fa-sync-alt"></i> Daten aktualisieren
            </button>
        </form>
    </div>
    <div class="block-content mb-3">
        @foreach ($user->lvs()->orderBy('gradebook', 'desc')->get() as $lv)
            <div>
                <h5>
                    <strong>{{ $lv->lvid }} {{ $lv->name }}</strong>
                    @if ($lv->gradebook)<span class="badge badge-pill badge-dark">{{ $lv->grades()->count() }} Noten</span>
                    @endif
                    <small>({{ $lv->SemesterText }})</small>
                </h5>
                @if ($lv->gradebook)
                Aktuell sind {{ $lv->grades()->count() }} Noten eingetragen. <a href="{{ route('user.wulearn.open', [$user->id, urlencode(urlencode($lv->url_gradebook))]) }}" target="_blank">Notenbuch in Learn@WU öffnen</a>.
                @endif
            </div>
            
            @if ($lv->gradebook)
            <div class="collapse gradebook">
                <table class="lv-entry table table-sm table-bordered mt-2">
                    <thead class="font-weight-bold ">
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
                        @if (isset($grade->points_sum))
                            <td>{{ ($grade->points_sum) }} von {{ $grade->points_max }}</td>
                        @else
                            <td>- (von {{ $grade->points_max }})</td>
                        @endif
                        <td>{{ $grade->entry_date }}</td>
                        <td>{{ $grade->teacher_name }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <p class="font-w700 text-success">Gesamtpunkte: {{ array_sum(array_column($lv->grades()->get()->toArray(), 'points_sum')) }} von {{ array_sum(array_column($lv->grades()->get()->toArray(), 'points_max')) }}</p>
                <br/>
            </div>
            @else
                <p>Kein Notenbuch vorhanden. <a href="{{ route('user.wulearn.open', [$user->id, urlencode(urlencode($lv->url))]) }}" target="_blank">LV in Learn@WU öffnen</a>.</p>
                <br/>
            @endif
        @endforeach
    </div>
</div>
<!-- END Lehrveranstaltungen und Noten -->

@endsection