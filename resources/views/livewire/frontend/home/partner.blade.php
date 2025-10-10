<div class="partner partner--gradient">
    <div class="container">
        <div class="partner__wrapper">
            <div class="partner__slider swiper">
                <div class="swiper-wrapper">

                    @foreach($partners as $partner)
                    <div class="swiper-slide">
                        <div class="partner__item">
                            <div class="partner__item-inner">
                                @if($partner->link)
                                <a href="{{ $partner->link }}" target="_blank" rel="noopener">
                                    <img src="{{ url('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="dark">
                                </a>
                                @else
                                <img src="{{ url('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="dark">
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>