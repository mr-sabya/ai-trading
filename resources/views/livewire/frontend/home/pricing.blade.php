<section class="pricing padding-top padding-bottom bg-color">
    <div class="section-header section-header--max50">
        <h2 class="mb-10 mt-minus-5">Our <span>pricing</span> plan</h2>
        <p>We offer the best pricings around - from installations to repairs, maintenance, and more!</p>
    </div>
    <div class="container">
        <div class="pricing__wrapper">
            <div class="row g-4 align-items-center">
                @foreach($packages as $package)
                <div class="col-md-6 col-lg-4">
                    <div class="pricing__item" data-aos="fade-up" data-aos-duration="1000">
                        <div class="pricing__item-inner {{ $loop->index == 1 ? 'active' : '' }}">
                            <div class="pricing__item-content">

                                <!-- Top -->
                                <div class="pricing__item-top">
                                    <h6 class="mb-15">{{ $package->name }}</h6>
                                    <h3 class="mb-25">${{ $package->first_price }}/<span>{{ ucfirst($package->billing_cycle) }}</span></h3>
                                </div>

                                <!-- Middle -->
                                <div class="pricing__item-middle">
                                    <ul class="pricing__list">
                                        @foreach($package->features as $feature)
                                        <li class="pricing__list-item">
                                            <span><img src="{{ url('assets/frontend/images/icon/check.svg') }}" alt="check" class="dark"></span>
                                            {{ $feature->feature_name }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Bottom -->
                                <div class="pricing__item-bottom">
                                    @if($this->hasPurchased($package->id))
                                    <span class="trk-btn trk-btn--outline disabled">Already Purchased</span>
                                    @else
                                    @auth
                                    <a href="{{ route('checkout.index', $package->id) }}" wire:navigate
                                        class="trk-btn trk-btn--outline {{ $loop->first ? 'active' : '' }}">
                                        Choose Plan
                                    </a>
                                    @else
                                    <a href="{{ route('login') }}" wire:navigate
                                        class="trk-btn trk-btn--outline {{ $loop->first ? 'active' : '' }}">
                                        Choose Plan
                                    </a>
                                    @endauth
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="pricing__shape">
        <span class="pricing__shape-item pricing__shape-item--1"><span></span></span>
        <span class="pricing__shape-item pricing__shape-item--2"><img src="{{ url('assets/frontend/images/icon/1.png') }}" alt="shape-icon"></span>
    </div>
</section>