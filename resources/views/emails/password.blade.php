@extends('layouts/email')

@section('content')
	<p>Click here to reset your password: {{ url('password/reset/'.$token) }}.</p>
	<p style="margin-bottom:0;">Ignore this message if you did not ask to reset your password.</p>
@endsection