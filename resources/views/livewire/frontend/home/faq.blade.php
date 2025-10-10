<section class="faq padding-top padding-bottom of-hidden">
    <div class="section-header section-header--max65">
        <h2 class="mb-10 mt-minus-5"><span>Frequently</span> Asked questions</h2>
        <p>Hey there! Got questions? We've got answers. Check out our FAQ page for all the deets. Still not satisfied? Hit us up.</p>
    </div>

    <div class="container">
        <div class="faq__wrapper">
            <div class="row g-5 align-items-center justify-content-between">
                <div class="col-lg-6">
                    <div class="accordion accordion--style1" id="faqAccordion1" data-aos="fade-right" data-aos-duration="1000">
                        <div class="row">
                            @foreach($faqs as $faq)
                            <div class="col-12">
                                <div class="accordion__item accordion-item {{ $loop->last ? 'border-0' : '' }}">
                                    <div class="accordion__header accordion-header" id="faq{{ $loop->iteration }}">
                                        <button class="accordion-button accordion__button {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#faqBody{{ $loop->iteration }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="faqBody{{ $loop->iteration }}">
                                            <span class="accordion__button-content">{{ $faq->question }}</span>
                                        </button>
                                    </div>
                                    <div id="faqBody{{ $loop->iteration }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="faq{{ $loop->iteration }}"
                                        data-bs-parent="#faqAccordion1">
                                        <div class="accordion__body accordion-body">
                                            <p class="mb-15">{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="faq__thumb faq__thumb--style1" data-aos="fade-left" data-aos-duration="1000">
                        <img class="dark" src="{{ url('assets/frontend/images/others/1.png') }}" alt="faq-thumb">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="faq__shape faq__shape--style1">
        <span class="faq__shape-item faq__shape-item--1">
            <img src="{{ url('assets/frontend/images/others/2.png') }}" alt="shape-icon">
        </span>
    </div>
</section>