@extends('layouts.backend')

@section('maincontent')

<!-- Studienplanpunkte -->
<h1>Offene Studienplanpunkte <small>(SPP)</small></h1>

<form class="mb-4" action="{{ route('user.wulpis.load.data', $user->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-primary">
        <i class="fas fa-sync-alt"></i> Daten aktualisieren
    </button>
</form>

<p>Aktuell sind {{ $user->planobjects()->count() }} Planpunkte vorhanden.</p>

<table class="table table-striped table-sm table-bordered">
    <thead class="font-w700 text-primary">
        <tr>
            <th>Planpunkt</th>
            <th>Antritte</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($user->planobjects()
                   ->orderBy('order', 'asc')
                   ->whereNotIn('type', ['S', 'A'])
                   ->whereNull('date')
                   ->get() as $planobject)
    <tr>
        <td class="pt-2 pb-2 depth_{{$planobject->depth}}">
            <strong class="font-w700">{{ $planobject->type }}</strong> {{ $planobject->name }}
            @if (isset($planobject->lv_url))
                <span class="badge badge-pill badge-success">LV Anmeldung möglich</span>
            @endif
            @if (isset($planobject->lv_status))
                <br/>
                Status: <a href="#">{{ $planobject->lv_status }}</a>
            @endif
        </td>
        <td>
            @if (isset($planobject->attempts_max))
                {{ $planobject->attempts }} von {{ $planobject->attempts_max }}
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<!-- END Noten -->

@endsection