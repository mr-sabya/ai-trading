<section class="team padding-top padding-bottom bg-color">
    <div class="section-header section-header--max50 text-center">
        <h2 class="mb-10 mt-minus-5">Meet our <span>advisers</span></h2>
        <p>Hey everyone, meet our amazing advisers! They're here to help and guide us through anything.</p>
    </div>

    <div class="container">
        <div class="team__wrapper">
            <div class="row g-4 align-items-center">
                @foreach ($teamMembers as $member)
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-duration="{{ 800 + ($loop->index % 4) * 100 }}">
                    <div class="team__item team__item--shape">
                        <div class="team__item-inner team__item-inner--shape">
                            <div class="team__item-thumb team__item-thumb--style1">
                                <img src="{{ url($member->image) }}" alt="{{ $member->name }}" class="dark">
                            </div>
                            <div class="team__item-content team__item-content--style1">
                                <div class="team__item-author team__item-author--style1">
                                    <div class="team__item-authorinfo">
                                        <h6 class="mb-1">
                                            <a href="{{ url('team/' . $member->slug) }}" class="stretched-link">
                                                {{ $member->name }}
                                            </a>
                                        </h6>
                                        <p class="mb-0">{{ $member->designation }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="text-center">
                    <a href="{{ url('team') }}" class="trk-btn trk-btn--border trk-btn--primary mt-25">View more</a>
                </div>
            </div>
        </div>
    </div>
</section>