@extends('frontend.layouts.app')

@section('content')
<!-- ================> Page header start here <================== -->
<livewire:frontend.theme.page-header :pageTitle="'Services'" :bgImage="asset('assets/frontend/images/header/1.png')" />
<!-- ================> Page header end here <================== -->




<!-- ===============>> Service section start here <<================= -->
<livewire:frontend.checkout.index packageId="{{ $package->id }}" />
<!-- ===============>> Service section start here <<================= -->

@endsection