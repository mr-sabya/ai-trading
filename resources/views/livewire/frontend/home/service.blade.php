<section class="service padding-top padding-bottom">
    <div class="section-header section-header--max50 text-center">
        <h2 class="mb-10 mt-minus-5"><span>services </span>We offer</h2>
        <p>We offer the best services around - from installations to repairs, maintenance, and more!</p>
    </div>

    <div class="container">
        <div class="service__wrapper">
            <div class="row g-4 align-items-center">
                @foreach ($services as $service)
                <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-duration="{{ 800 + ($loop->index * 200) }}">
                    <div class="service__item service__item--style1 text-center">
                        <div class="service__item-inner">
                            <div class="service__item-thumb mb-30">
                                <img class="dark" src="{{ url('storage/' . $service->image) }}" alt="{{ $service->title }}">
                            </div>
                            <div class="service__item-content">
                                <h5>
                                    <a class="stretched-link" href="{{ url('service/' . $service->slug) }}">
                                        {{ $service->title }}
                                    </a>
                                </h5>
                                <p class="mb-0">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>