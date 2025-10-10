<section class="banner banner--style1">
    <div class="banner__bg">
        <div class="banner__bg-element">
            @if($banner && $banner->background_image)
            <img src="{{ asset($banner->background_image) }}" alt="section-bg-element" class="dark d-none d-lg-block">
            @endif
            <span class="bg-color d-lg-none"></span>
        </div>
    </div>

    <div class="container">
        <div class="banner__wrapper">
            <div class="row gy-5 gx-4">
                <div class="col-lg-6 col-md-7">
                    <div class="banner__content" data-aos="fade-right" data-aos-duration="1000">

                        <div class="banner__content-coin">
                            <img src="{{ asset('assets/frontend/images/banner/home1/3.png') }}" alt="coin icon">
                        </div>

                        <h1 class="banner__content-heading">
                            {{ $banner->heading ?? 'Default Heading' }}
                            <span>{{ $banner->highlight ?? '' }}</span>
                        </h1>

                        <p class="banner__content-moto">
                            {{ $banner->description ?? 'Default description goes here.' }}
                        </p>

                        <div class="banner__btn-group btn-group">
                            @if($banner->button_link)
                            <a href="{{ $banner->button_link }}" class="trk-btn trk-btn--primary trk-btn--arrow">
                                {{ $banner->button_text ?? 'Get Started' }}
                                <span><i class="fa-solid fa-arrow-right"></i></span>
                            </a>
                            @endif

                            @if($banner->video_link)
                            <a href="{{ $banner->video_link }}" class="trk-btn trk-btn--outline22" data-fslightbox>
                                <span class="style1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M10.5547 7.03647C9.89015 6.59343 9 7.06982 9 7.86852V16.1315C9 16.9302 9.89015 17.4066 10.5547 16.9635L16.7519 12.8321C17.3457 12.4362 17.3457 11.5638 16.7519 11.1679L10.5547 7.03647Z"
                                            stroke="#A4FD5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <rect x="-0.75" y="0.75" width="22.5" height="22.5" rx="11.25" transform="matrix(-1 0 0 1 22.5 0)"
                                            stroke="#A4FD5" stroke-width="1.5" />
                                    </svg>
                                </span> Watch Video
                            </a>
                            @endif
                        </div>

                        <div class="banner__content-social">
                            <p>Follow Us</p>
                            <ul class="social">
                                @foreach (['facebook-f','linkedin-in','instagram','youtube','twitter'] as $icon)
                                <li class="social__item">
                                    <a href="#" class="social__link social__link--style1"><i class="fab fa-{{ $icon }}"></i></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-5">
                    <div class="banner__thumb" data-aos="fade-left" data-aos-duration="1000">
                        @if($banner && $banner->image)
                        <img src="{{ asset($banner->image) }}" alt="banner-thumb" class="dark">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="banner__shape">
        <span class="banner__shape-item banner__shape-item--1">
            <img src="{{ asset('assets/frontend/images/banner/home1/4.png') }}" alt="shape icon">
        </span>
    </div>
</section>