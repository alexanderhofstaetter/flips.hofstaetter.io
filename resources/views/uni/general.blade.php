@extends('layouts.backend')

@section('maincontent')

<!-- Authentifizierung -->
<div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
        <h4 class="block-title mb-0 float-left"><strong>WU</strong> Authentifizierungseinstellungen</h4>
        <form action="{{ route('user.wulearn.verify', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm float-right">
                <i class="fas fa-plug"></i> Verbindung testen
            </button>
        </form>
    </div>
    <div class="block-content mb-5">
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
<!-- END Authentifizierung -->

<!-- Informationen -->
<div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
        <h4 class="block-title mb-0 float-left">
            Allgemeine Informationen
        </h4>
        <form action="{{ route('user.wulearn.load.meta', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm float-right">
                <i class="fas fa-sync-alt"></i> Daten aktualisieren
            </button>
        </form>
    </div>
    <div class="block-content mb-3">
        <p>
            <strong>Name</strong>: {{ $user->name }}
            <strong class="ml-2">Kennung</strong>: {{ $user->wuidentification }}
            <strong class="ml-2">WU E-Mail-Adresse</strong>: {{ $user->wuemail }}<br/>
        </p>
        <hr/>
        {{ $user->wuregistered_at }}
        <?php $activity = $user->activities()->where('identifier', 'wu-learn-api')->orderBy('created_at', 'desc')->first(); ?>
        @if ($activity)
            <span class="float-right">
                <span class="mr-2">Leztzte Verbindung zu Learn@WU: {{ $activity->created_at }}</span>
                Status: <span class="text-{{ $activity->status }}">{{ $activity->status }}</span>
            </span>
        @endif    
    </div>
</div>
<!-- END Informationen -->

@endsection