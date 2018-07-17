@extends('layouts.backend')

@section('maincontent')

<!-- LV/PI Anmeldungen -->
<div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
        <h4 class="block-title mb-0 float-left">
            LV/PI Anmeldungen
        </h4>

        <form action="{{ route('user.wulearn.load.exams', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm float-right">
                <i class="fas fa-sync-alt"></i> Daten aktualisieren
            </button>
        </form>
    </div>
    <div class="block-content mb-3">
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
        <p>
            Aktuell sind keine weitere Anmeldungen vorhanden.
        </p>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegistrationModal">
            <i class="fas fa-plus"></i>
            Anmeldung hinzufügen
        </button>
    </div>
</div>
<!-- END LV/PI Anmeldungen -->

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