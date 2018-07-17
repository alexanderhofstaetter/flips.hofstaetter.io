@extends('layouts.backend')

@section('maincontent')

<h1>Link öffnen und anmelden</h1>
<p>
	Folgender Button öffnet den angegeben Link und meldet den User automatisch in Learn@WU an.
</p>
<p>
	<span class="font-w700 text-primary">Benutzername</span>: {{ $payload['username'] }}<br/>
	<span class="font-w700 text-primary">URL</span>: https://learn.wu.ac.at{{ urldecode($payload['url']) }}
</p>


<form class="wulearnform_open" id="wulearnform_open" method="post" action="https://learn.wu.ac.at/register/" target="_blank">
	
	<input type="hidden" name="form:mode" value="{{ $payload['form:mode'] }}">
	<input type="hidden" name="form:id" value="{{ $payload['form:id'] }}">
	<input type="hidden" id="username" name="username" value="{{ $payload['username'] }}">
	<input type="hidden" id="password" name="password" value="{{ $payload['password'] }}">
	<input type="hidden" id="login_formbutton:ok" name="formbutton:ok" value="Anmelden">
	<input type="hidden" id="login:__confirmed_p:0" name="__confirmed_p" value="0">
	<input type="hidden" id="login:__refreshing_p:0" name="__refreshing_p" value="0">
	<input type="hidden" id="login:__submit_button_name:0" name="__submit_button_name" value="">
	<input type="hidden" id="login:__submit_button_value:0" name="__submit_button_value" value="">
	<input type="hidden" id="login:return_url:0" name="return_url" value="/{{ $payload['url'] }}">
	<input type="hidden" id="login:time:0" name="time" value="{{ $payload['time'] }}">
	<input type="hidden" id="login:host_node_id:0" name="host_node_id" value="">
	<input type="hidden" id="login:token_id:0" name="token_id" value="{{ $payload['token_id'] }}">
	<input type="hidden" id="login:hash:0" name="hash" value="{{ $payload['hash'] }}">

	<button type="submit" class="btn btn-primary">
		<i class="si si-link"></i> Link in Learn@WU öffnen
	</button>

</form>

@endsection