@extends('frontend.layouts.app')

@section('content')

<!-- ================> Page header start here <================== -->
<livewire:frontend.theme.page-header :pageTitle="'Singup'" :bgImage="asset('assets/frontend/images/header/1.png')" />
<!-- ================> Page header end here <================== -->

<!-- ===============>> account start here <<================= -->
<livewire:frontend.auth.register />
<!-- ===============>> account start here <<================= -->


@endsection