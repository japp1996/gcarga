@extends('layouts.admin')
@section('title', 'Conductor')
@section('text', 'Datos del conductor')
@section('content')
	@if($conductor == "")
		<driver-index :vehiculos="{{ $vehiculos }}" :bancos="{{ $bancos }}"></driver-index>
	@else
		<driver-edit-index :vehiculos="{{ $vehiculos }}" :cuenta="{{ $cuenta }}" :conductor="{{ $conductor }}" :bancos="{{ $bancos }}"></driver-edit-index>
	@endif()
@endsection()