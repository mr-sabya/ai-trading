@extends('frontend.layouts.app')

@section('content')

<!-- ================> Page header start here <================== -->
<livewire:frontend.theme.page-header :pageTitle="'About Us'" :bgImage="asset('assets/frontend/images/header/1.png')" />
<!-- ================> Page header end here <================== -->

<!-- ===============>> Contact section start here <<================= -->
<div class="contact padding-top padding-bottom">
    <div class="container">
        <div class="contact__wrapper">
            <div class="row g-5">
                <div class="col-md-5">
                    <div class="contact__info" data-aos="fade-right" data-aos-duration="1000">
                        <div class="contact__social">
                            <h3>let’s <span>get in touch</span>
                                with us</h3>
                            <ul class="social">
                                <li class="social__item">
                                    <a href="{{ $settings->facebook ?? '#' }}" target="_blank" class="social__link social__link--style4 active"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="social__item">
                                    <a href="{{ $settings->instagram ?? '#' }}" target="_blank" class="social__link social__link--style4 "><i class="fab fa-instagram"></i></a>
                                </li>
                                <li class="social__item">
                                    <a href="{{ $settings->linkedin ?? '#' }}" target="_blank" class="social__link social__link--style4"><i class="fa-brands fa-linkedin-in"></i></a>
                                </li>
                                <li class="social__item">
                                    <a href="{{ $settings->youtube ?? '#' }}" target="_blank" class="social__link social__link--style4"><i class="fab fa-youtube"></i></a>
                                </li>
                                <li class="social__item">
                                    <a href="{{ $settings->twitter ?? '#' }}" target="_blank" class="social__link social__link--style4"><i class="fab fa-twitter"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="contact__details">
                            <div class="contact__item" data-aos="fade-right" data-aos-duration="1000">
                                <div class="contact__item-inner">
                                    <div class="contact__item-thumb">
                                        <span><img src="{{ url('assets/frontend/images/contact/1.png') }}" alt="contact-icon" class="dark"></span>
                                    </div>
                                    <div class="contact__item-content">
                                        <p>
                                            {{ $settings->phone }}
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="contact__item" data-aos="fade-right" data-aos-duration="1100">
                                <div class="contact__item-inner">
                                    <div class="contact__item-thumb">
                                        <span><img src="{{ url('assets/frontend/images/contact/2.png') }}" alt="contact-icon" class="dark"></span>
                                    </div>
                                    <div class="contact__item-content">
                                        <p>
                                            {{ $settings->email }}
                                        </p>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="contact__item" data-aos="fade-right" data-aos-duration="1200">
                                <div class="contact__item-inner">
                                    <div class="contact__item-thumb">
                                        <span><img src="{{ url('assets/frontend/images/contact/3.png') }}" alt="contact-icon" class="dark"></span>
                                    </div>
                                    <div class="contact__item-content">
                                        <p>
                                            {{ $settings->address }}
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="contact__form">
                        <form action="/" data-aos="fade-left" data-aos-duration="1000">
                            <div class="row g-4">
                                <div class="col-12">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input class="form-control" type="text" id="name" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div>
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="email" id="email" placeholder="Email here">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div>
                                        <label for="textarea" class="form-label">Message</label>
                                        <textarea cols="30" rows="5" class="form-control" id="textarea"
                                            placeholder="Enter Your Message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="trk-btn trk-btn--border trk-btn--primary mt-4 d-block">contact us
                                now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact__shape">
        <span class="contact__shape-item contact__shape-item--1"><img src="{{ url('assets/frontend/images/contact/4.png') }}"
                alt="shape-icon"></span>
        <span class="contact__shape-item contact__shape-item--2"> <span></span> </span>
    </div>
</div>
<!-- ===============>> Contact section start here <<================= -->


<!-- ===============>> cta section start here <<================= -->
<livewire:frontend.home.cta />
<!-- ===============>> cta section start here <<================= -->


@endsection