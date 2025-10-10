@extends('frontend.layouts.app')

@section('content')

<!-- ================> Page header start here <================== -->
<livewire:frontend.theme.page-header :pageTitle="'About Us'" :bgImage="asset('assets/frontend/images/header/1.png')" />
<!-- ================> Page header end here <================== -->

<!-- ===============>> Story section start here <<================= -->
<div class="story padding-top bg-color-3">
    <div class="container">
        <div class="story__wrapper">
            <div class="story__thumb">
                <div class="story__thumb-inner" data-aos="fade-up" data-aos-duration="800">
                    <img src="{{ url('assets/frontend/images/about/4.png') }}" alt="story-image">
                    <div class="story__thumb-playbtn">
                        <a href="https://www.youtube.com/watch?v=uJSgaPIvgKk&ab_channel=FreeTemplates" data-fslightbox><i
                                class="fa-solid fa-circle-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="story__shape">
        <span class="story__shape-item story__shape-item--1"><span></span> </span>
    </div>
</div>
<!-- ===============>> Story section end here <<================= -->



<!-- ===============>> About section start here <<================= -->
<livewire:frontend.home.about />
<!-- ===============>> About section start here <<================= -->



<!-- ========== Roadmap Section start Here========== -->
<livewire:frontend.home.testimonial />
<!-- ========== Roadmap Section Ends Here========== -->



<!-- ===============>> Team section start here <<================= -->
<livewire:frontend.home.team />
<!-- ===============>> Team section start here <<================= -->



<!-- ===============>> cta section start here <<================= -->
<livewire:frontend.home.cta />
<!-- ===============>> cta section start here <<================= -->


@endsection