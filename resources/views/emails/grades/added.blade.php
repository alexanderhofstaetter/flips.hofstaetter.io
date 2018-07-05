@component('mail::message')
# Hallo {{ $user->firstname }}!

In der Lehrveranstaltung *{{ $lv->lvid }} - {{ $lv->name }}* wurde eine neue Note hinzugefügt.
@component('mail::table')
Bezeichnung | Punkte | Datum | Eingetragen von
:--- | :--- | :--- | :---
{{ $grade->title }} | **{{ $grade->points_sum }} von {{ $grade->points_max }}** | {{ $grade->entry_date->diffForHumans() }} | {{ $grade->teacher_name }}
@endcomponent

@component('mail::button', ['url' => $lv->url_gradebook])
Notenbuch in Learn@WU öffnen 
@endcomponent

Liebe Grüße

<br/><br/>
# {{ $lv->name }}

In dieser Lehrveranstaltung sind aktuell {{ $lv->grades()->count() }} Noten eingetragen.
@component('mail::table')
Name | Punkte | Datum | Eingetragen von
:--- | :--- | :--- | :---
@foreach ($lv->grades()->orderBy('title')->whereNotNull('entry_date')->get() as $grade)
{{ $grade->title }} | {{ ($grade->points_sum) }} von {{ $grade->points_max }} | {{ $grade->entry_date->format('d.m.Y') }} | {{ $grade->teacher_name }}
@endforeach
@endcomponent

**Gesamtpunkte: {{ array_sum(array_column($lv->grades()->get()->toArray(), 'points_sum')) }} von {{ array_sum(array_column($lv->grades()->get()->toArray(), 'points_max')) }}**
@endcomponent