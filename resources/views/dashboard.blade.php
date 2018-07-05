@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<img src="{{asset('images/wu-wien-logo.svg')}}" class="mx-auto d-block mb-4"/>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @include('flash::message')

            <div class="card card-default mb-4">
                <div class="card-header">
                    <h4 class="mb-0 float-left"><strong>WU</strong> Authentifizierungseinstellungen</h4>
                    <form action="{{ route('user.wulearn.verify', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm float-right">
                            <i class="fas fa-plug"></i> Verbindung testen
                        </button>
                    </form>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        <div class="row float-left">
                            <div class='col-md-6'>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Benutzername</span>
                                    </div>
                                    <input name="wulogin" type="text" class="form-control" placeholder="h01234567" value="{{ $user->wulogin }}">
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Passwort</span>
                                    </div>
                                    <input name="wupassword" type="password" class="form-control" placeholder="{{ ($user->wupassword) ? "••••••••••••" : "" }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">
                            Daten speichern
                        </button>
                    </form>
                </div>
            </div>
            <div class="card card-default mb-4">
                <div class="card-header">
                    <h4 class="mb-0 float-left">Allgemeine Informationen</h4>
                    <form action="{{ route('user.wulearn.load.meta', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm float-right">
                            <i class="fas fa-sync-alt"></i> Daten aktualisieren
                        </button>
                    </form>
                </div>

                <div class="card-body">           
                    <p>
                        <strong>Name</strong>: {{ $user->name }}
                        <strong class="ml-2">Kennung</strong>: {{ $user->identification }}
                        <strong class="ml-2">WU E-Mail-Adresse</strong>: {{ $user->profile_email }}<br/>
                    </p>
                    <hr/>
                    {{ $user->registered_at }}
                    <?php $activity = $user->activities()->where('identifier', 'wu-learn-api')->orderBy('created_at', 'desc')->first(); ?>
                    @if ($activity)
                        <span class="float-right">
                            <span class="mr-2">Leztzte Verbindung zu Learn@WU: {{ $activity->created_at }}</span>
                            Status: <span class="text-{{ $activity->status }}">{{ $activity->status }}</span>
                        </span>
                    @endif
                </div>
            </div>
            <div class="card card-default mb-4">
                <div class="card-header">
                    <h4 class="mb-0  float-left">Aktuelle Lehrveranstaltungen und Noten</h4>
                    <form action="{{ route('user.wulearn.load.data', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm float-right">
                            <i class="fas fa-sync-alt"></i> Daten aktualisieren
                        </button>
                    </form>
                </div>                                

                <div class="card-body">  
                    Text
                    <button class="btn btn-outline-secondary btn-sm float-right" type="button" data-toggle="collapse" data-target=".gradebook" aria-expanded="true"><i class="fas fa-toggle-off"></i> Anzeige Noten</button>


                    <hr/><br/>

                    @foreach ($user->lvs()->orderBy('gradebook', 'desc')->get() as $lv)
                        <div>
                            <h5>
                                <strong>{{ $lv->lvid }} {{ $lv->name }}</strong>
                                @if ($lv->gradebook)<span class="badge badge-pill badge-dark">{{ $lv->grades()->count() }} Noten</span>
                                @endif
                                <small>({{ $lv->SemesterText }})</small>
                            </h5>
                            @if ($lv->gradebook)
                            Aktuell sind {{ $lv->grades()->count() }} Noten eingetragen. <a href="{{ $lv->url_gradebook }}" target="_blank">Notenbuch in Learn@WU öffnen</a>.
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
                                <tr class="{{ ($grade->points_sum) ? "" : "text-muted" }}">
                                    <td style="width: 45%;">{{ $grade->title }}</td>
                                    @if ($grade->points_sum)
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
                            <p class="font-weight-bold ">Gesamtpunkte: {{ array_sum(array_column($lv->grades()->get()->toArray(), 'points_sum')) }} von {{ array_sum(array_column($lv->grades()->get()->toArray(), 'points_max')) }}</p>
                            <br/>
                        </div>
                        @else
                            <p>Kein Notenbuch vorhanden. <a href="{{ $lv->url }}" target="_blank">LV in Learn@WU öffnen</a>.</p>
                            <br/>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="card card-default mb-4">
                <div class="card-header">
                    <h4 class="mb-0 float-left">Prüfungseinsicht</h4>
                    <form action="{{ route('user.wulearn.load.webview', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm float-right">
                            <i class="fas fa-sync-alt"></i> Daten aktualisieren
                        </button>
                    </form>
                </div>

                <div class="card-body">           
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
            <div class="card card-default mb-4">
                <div class="card-header">
                    <h4 class="mb-0">LV/PI Anmeldungen <span class="badge badge-secondary">1</span></h4>
                </div>

                <div class="card-body">
                    <div class="card mb-3">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p>
                                <strong>Internationale Makroökonomik</strong>, Kukuvec A. <span class="badge badge-secondary">4731</span><br/>
                                Anmeldung wird durchgeführt am 10.03.2018, 14:00 Uhr
                            </p>
                            <a href="#" class="btn btn-danger btn-sm active float-right">Abbrechen</a>
                        </li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                      </ul>
                    </div>
                    <p>
                        Aktuell sind keine weitere Anmeldungen vorhanden.
                    </p>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#RegistrationModal">
                        <i class="fas fa-plus"></i>
                        Anmeldung hinzufügen
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="RegistrationModal" tabindex="-1" role="dialog" aria-labelledby="RegistrationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="RegistrationModalLabel">Neue Anmeldung hinzufügen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="studium">Studium</label>
                </div>
                <select class="custom-select" id="studium">
                    <option selected>Auswählen ...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="abschnitt">Abschnitt</label>
                </div>
                <select class="custom-select" id="abschnitt">
                    <option selected>Auswählen ...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="planpunkt">Planpunkt</label>
                </div>
                <select class="custom-select" id="planpunkt">
                    <option selected>Auswählen ...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="veranstaltung">Veranstaltung</label>
                </div>
                <select class="custom-select" id="veranstaltung">
                    <option selected>Auswählen ...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
        <button type="button" class="btn btn-primary">Hinzufügen</button>
      </div>
    </div>
  </div>
</div>

@endsection