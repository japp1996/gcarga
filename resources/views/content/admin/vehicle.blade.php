@extends('layouts.admin')
@section('title', 'Vehículos')
@section('text', 'Datos del Vehículo')
@section('content')
	@if($vehiculo == "")
		<vehicle-index :tipo="{{$tipo}}" :marca="{{$marca}}" :peso="{{$peso}}" :volumen="{{$volumen}}"></vehicle-index>
	@else
		<vehicle-edit-index :tipo="{{$tipo}}" :marca="{{$marca}}" :peso="{{$peso}}" :volumen="{{$volumen}}" :vehiculo="{{ $vehiculo }}" :fotos="{{ $fotos }}"></vehicle-edit-index>
	@endif()

@endsection()