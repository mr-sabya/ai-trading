@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')

<livewire:backend.package.feature-manage package="{{ $package->id }}" />

@endsection