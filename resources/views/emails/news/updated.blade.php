@component('mail::message')
# Hallo {{ $user->firstname }}!

In der Lehrveranstaltung *{{ $lv->key }} {{ $lv->name }}* wurde soeben eine Ankündigung erstellt.

## {{ $news->title }}

{!! $news->content !!}
*Veröffentlicht von {{ $news->author }} am {{ $news->date->format("d.m.Y") }}*.

@component('mail::button', ['url' => $news->url])
Ankündigung in Learn@WU öffnen 
@endcomponent

@endcomponent