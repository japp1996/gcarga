@extends('layouts.login')
@section('title', 'Login')
@section('content')
	<usuario-login></usuario-login>
@endsection()
@section('script')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@endsection('')