@extends('frontend.layouts.app')

@section('content')
<!-- ================> Page header start here <================== -->
<livewire:frontend.theme.page-header :pageTitle="'Services'" :bgImage="asset('assets/frontend/images/header/1.png')" />
<!-- ================> Page header end here <================== -->




<!-- ===============>> Service section start here <<================= -->
<livewire:frontend.home.service />
<!-- ===============>> Service section start here <<================= -->





<!-- ===============>> Testimonial section start here <<================= -->
<livewire:frontend.home.testimonial />
<!-- ===============>> Testimonial section start here <<================= -->




<!-- ===============>> cta section start here <<================= -->
<livewire:frontend.home.cta />
<!-- ===============>> cta section start here <<================= -->
@endsection