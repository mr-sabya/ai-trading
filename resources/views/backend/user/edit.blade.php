@extends('backend.layouts.app')

@section('title', 'Edit User')

@section('content')

<livewire:backend.user.manage userId="{{ $user->id }}" />

@endsection