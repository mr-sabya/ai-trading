@extends('backend.layouts.app')

@section('title', 'User')

@section('content')

<livewire:backend.user.show id="{{ $user->id }}" />

@endsection