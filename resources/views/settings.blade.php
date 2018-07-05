@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <img src="{{asset('images/wu-wien-logo.svg')}}" class="mx-auto d-block mb-4"/>

            <div class="card card-default mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Einstellungen</h5>
                </div>

                <div class="card-body">
                    Einstellungen ...
                </div>
            </div>
        
        </div>
    </div>
</div>

<div class="modal fade" id="RegistrationModal" tabindex="-1" role="dialog" aria-labelledby="RegistrationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RegistrationModalLabel">Neue Anmeldung hinzufügen</h5>
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
