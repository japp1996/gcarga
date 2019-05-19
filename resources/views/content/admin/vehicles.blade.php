@extends('layouts.admin')
@section('title', 'Vehículos')
@section('text', 'Vehículos')
@section('content')
	<vehicle-all-index :vehiculos="{{ $vehiculos }}" :max_transp="{{ $empresas->max_vehicle }}"></vehicle-all-index>
@endsection()