@extends('layouts.admin')
@section('title', 'Conductores')
@section('text', 'Conductores')
@section('content')
	<driver-all-index :conductores="{{ $conductores }}"></driver-all-index>
@endsection()