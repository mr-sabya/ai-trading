<section class="feature feature--style1 padding-bottom padding-top bg-color">
    <div class="container">
        <div class="feature__wrapper">
            <div class="row g-5 align-items-center justify-content-between">
                <div class="col-md-6 col-lg-5">
                    <div class="feature__content" data-aos="fade-right" data-aos-duration="800">
                        <div class="feature__content-inner">
                            <div class="section-header">
                                <h2 class="mb-10 mt-minus-5"><span>Benefits </span>We Offer</h2>
                                <p class="mb-0">Unlock the full potential of our product with our amazing features.</p>
                            </div>

                            <div class="feature__nav">
                                <div class="nav nav--feature flex-column nav-pills" id="feat-pills-tab" role="tablist">
                                    @foreach ($features as $index => $feature)
                                    <div class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="feat-pills-{{ $index }}-tab"
                                        data-bs-toggle="pill"
                                        data-bs-target="#feat-pills-{{ $index }}"
                                        role="tab"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <div class="feature__item">
                                            <div class="feature__item-inner">
                                                <div class="feature__item-content">
                                                    <h6>{{ $feature->title }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="feature__thumb pt-5 pt-md-0" data-aos="fade-left" data-aos-duration="800">
                        <div class="feature__thumb-inner">
                            <div class="tab-content" id="feat-pills-tabContent">
                                @foreach ($features as $index => $feature)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="feat-pills-{{ $index }}" role="tabpanel"
                                    aria-labelledby="feat-pills-{{ $index }}-tab">
                                    <div class="feature__image floating-content">
                                        <img src="{{ url('storage/'. $feature->main_image) }}" alt="Feature image">

                                        <div class="floating-content__top-right floating-content__top-right--style2">
                                            <div class="floating-content__item floating-content__item--style2 text-center">
                                                <img src="{{ url('storage/'. $feature->floating_top_image) }}" alt="rating">
                                                <p class="style2">{{ $feature->floating_top_text }}</p>
                                            </div>
                                        </div>

                                        <div class="floating-content__bottom-left floating-content__bottom-left--style2">
                                            <div class="floating-content__item floating-content__item--style3 d-flex align-items-center">
                                                <h3 class="style2">
                                                    <span>{{ $feature->floating_bottom_number }}</span>
                                                </h3>
                                                <p class="ms-3 style2">{{ $feature->floating_bottom_text }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="feature__shape">
        <span class="feature__shape-item feature__shape-item--1">
            <img src="{{ url('assets/frontend/images/feature/shape/1.png') }}" alt="shape-icon">
        </span>
        <span class="feature__shape-item feature__shape-item--2"><span></span></span>
    </div>
</section>