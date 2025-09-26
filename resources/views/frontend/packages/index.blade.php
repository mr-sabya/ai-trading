@extends('frontend.layouts.app')

@section('content')
<!-- ================> Page header start here <================== -->
<livewire:frontend.theme.page-header :pageTitle="'Pricing'" :bgImage="asset('assets/frontend/images/header/1.png')" />
<!-- ================> Page header end here <================== -->


<!-- ===============>> Pricing section start here <<================= -->
<livewire:frontend.home.pricing />
<!-- ===============>> Pricing section start here <<================= -->


<!-- ===============>> Testimonial section start here <<================= -->
<livewire:frontend.home.testimonial />
<!-- ===============>> Testimonial section start here <<================= -->

<!-- ===============>> FAQ section start here <<================= -->
<livewire:frontend.home.faq />
<!-- ===============>> FAQ section start here <<================= -->

<!-- ===============>> cta section start here <<================= -->
<livewire:frontend.home.cta />
<!-- ===============>> cta section start here <<================= -->

@endsection