@extends('layouts.admin')
@section('title', 'Compañia')
@section('text', 'Datos de la Empresa')
@section('content')
	<company-index :datos="{{ $empresas }}"></company-index>
@endsection()