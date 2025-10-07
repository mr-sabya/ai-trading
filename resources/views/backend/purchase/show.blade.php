@extends('backend.layouts.app')

@section('title', 'Purchase List')

@section('content')

<livewire:backend.purchase.show id="{{ $purchase->id }}" />

@endsection