@extends('layouts.email')

@section('content')
	<p style="margin:0;font-weight:bold;">Welcome on Tacticode {{$user->login}}!</p>
  	<p>You can begin by creating a new character: {{ action('CharactersController@index') }}.</p>
	<p style="margin-bottom:0;">See you soon in the arena !</p>
@endsection