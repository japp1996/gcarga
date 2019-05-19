@extends('layouts.admin')
@section('title', 'Vehículos')
@section('text', 'Datos del Vehículo')
@section('content')
	@if($vehiculo == "")
		<transport-index :tipo="{{$tipo}}" :marca="{{$marca}}" :peso="{{$peso}}" :volumen="{{$volumen}}"></transport-index>
	@else
		<transport-edit-index :tipo="{{$tipo}}" :marca="{{$marca}}" :peso="{{$peso}}" :volumen="{{$volumen}}" :vehiculo="{{ $vehiculo }}" :fotos="{{ $fotos }}"></transport-edit-index>
	@endif()

@endsection()