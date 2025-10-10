<section class="about about--style1">
    <div class="container">
        <div class="about__wrapper">
            <div class="row gx-5 gy-4 gy-sm-0 align-items-center">

                <div class="col-lg-6">
                    <div class="about__thumb pe-lg-5" data-aos="fade-right" data-aos-duration="800">
                        <div class="about__thumb-inner">
                            <div class="about__thumb-image floating-content">
                                <img class="dark" src="{{ asset($about->image ?? 'assets/frontend/images/about/1.png') }}" alt="about-image">

                                <div class="floating-content__top-left" data-aos="fade-right" data-aos-duration="1000">
                                    <div class="floating-content__item">
                                        <h3>
                                            <span class="purecounter"
                                                data-purecounter-start="0"
                                                data-purecounter-end="{{ $about->exp_years_value ?? 0 }}">
                                                {{ $about->exp_years_value ?? 0 }}
                                            </span> Years
                                        </h3>
                                        <p>{{ $about->exp_years_label ?? 'Consulting Experience' }}</p>
                                    </div>
                                </div>

                                <div class="floating-content__bottom-right" data-aos="fade-right" data-aos-duration="1000">
                                    <div class="floating-content__item">
                                        <h3>
                                            <span class="purecounter"
                                                data-purecounter-start="0"
                                                data-purecounter-end="{{ preg_replace('/[^0-9]/', '', $about->customers_value ?? '0') }}">
                                                {{ $about->customers_value ?? '0' }}
                                            </span>
                                        </h3>
                                        <p>{{ $about->customers_label ?? 'Satisfied Customers' }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about__content" data-aos="fade-left" data-aos-duration="800">
                        <div class="about__content-inner">
                            <h2>
                                {{ $about->title ?? 'Meet' }}
                                <span>{{ $about->highlight ?? 'our company' }}</span>
                                {{ $about->subtitle ?? '' }}
                            </h2>

                            <p class="mb-0">
                                {{ $about->description ?? 'Default about section description.' }}
                            </p>

                            @if($about->button_link)
                            <a href="{{ $about->button_link }}" class="trk-btn trk-btn--border trk-btn--primary">
                                {{ $about->button_text ?? 'Explore More' }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>