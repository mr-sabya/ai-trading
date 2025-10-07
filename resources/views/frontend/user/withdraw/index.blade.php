@extends('frontend.layouts.app')

@section('title', 'User Dashboard')

@section('content')

<!-- ================> Page header start here <================== -->
<livewire:frontend.theme.page-header :pageTitle="'Withdraw'" :bgImage="asset('assets/frontend/images/header/1.png')" />
<!-- ================> Page header end here <================== -->



<section class="dashboard padding-top padding-bottom sec-bg-color2">
    <div class="container">
        <div class="row g-4">

            <!-- Sidebar -->
            <livewire:frontend.user.menu />

            <!-- Main Content -->
            <livewire:frontend.user.withdraw />


        </div>
    </div>
</section>
@endsection