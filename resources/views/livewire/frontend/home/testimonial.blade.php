<section class="testimonial padding-top padding-bottom-style2 bg-color">
    <div class="container">
        <div class="section-header d-md-flex align-items-center justify-content-between">
            <div class="section-header__content">
                <h2 class="mb-10">connect with <span>our Clients</span></h2>
                <p class="mb-0">We love connecting with our clients to hear about their experiences and how we can improve.</p>
            </div>
            <div class="section-header__action">
                <div class="swiper-nav">
                    <button class="swiper-nav__btn testimonial__slider-prev">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <button class="swiper-nav__btn testimonial__slider-next active">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="testimonial__wrapper" data-aos="fade-up" data-aos-duration="1000">
            <div class="testimonial__slider swiper">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="testimonial__item testimonial__item--style1">
                            <div class="testimonial__item-inner">
                                <div class="testimonial__item-content">
                                    <p class="mb-0">{{ $testimonial->message }}</p>
                                    <div class="testimonial__footer">
                                        <div class="testimonial__author">
                                            <div class="testimonial__author-thumb">
                                                <img src="{{ url($testimonial->image) }}" alt="{{ $testimonial->name }}">
                                            </div>
                                            <div class="testimonial__author-designation">
                                                <h6>{{ $testimonial->name }}</h6>
                                                <span>{{ $testimonial->designation }}</span>
                                            </div>
                                        </div>
                                        <div class="testimonial__quote">
                                            <span><i class="fa-solid fa-quote-right"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>