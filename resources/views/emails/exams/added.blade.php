@component('mail::message')
# Hallo {{ $user->firstname }}!

Die Prüfung **{{ $exam->title }}** vom {{ $exam->date->format("d.m.Y") }} ist nun zur digitalen Einsicht verfügbar.
<br/><br/>
Sie finden die Ergebnisse der Prüfung als Anhang in diesem Mail.

@component('mail::button', ['url' => "https://learn.wu.ac.at/einsicht/index"])
Prüfungseinsicht Learn@WU
@endcomponent

Liebe Grüße
@endcomponent