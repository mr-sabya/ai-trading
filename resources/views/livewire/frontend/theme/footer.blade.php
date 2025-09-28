<footer class="footer">
    <div class="container">
        <div class="footer__wrapper">
            <!-- Top Section -->
            <div class="footer__top footer__top--style1">
                <div class="row gy-5 gx-4">
                    <!-- About & App Links -->
                    <div class="col-md-6">
                        <div class="footer__about">
                            <a href="{{ route('home.index') }}" class="footer__about-logo" wire:navigate>
                                <img src="{{ $settings->dark_logo ? asset('storage/' . $settings->dark_logo) : url('assets/frontend/images/logo/logo-dark.png') }}" alt="{{ $settings->website_name ?? 'Website' }}">
                            </a>
                            <p class="footer__about-moto">{{ $settings->short_description ?? 'Welcome to our trading site!' }}</p>
                            <div class="footer__app">
                                <div class="footer__app-item footer__app-item--apple">
                                    <div class="footer__app-inner">
                                        <div class="footer__app-thumb">
                                            <a href="{{ $settings->apple_store_link ?? 'https://www.apple.com/app-store/' }}" target="_blank" class="stretched-link">
                                                <img src="{{ url('assets/frontend/images/footer/apple.png') }}" alt="apple-icon">
                                            </a>
                                        </div>
                                        <div class="footer__app-content">
                                            <span>Download on the</span>
                                            <p class="mb-0">App Store</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer__app-item footer__app-item--playstore">
                                    <div class="footer__app-inner">
                                        <div class="footer__app-thumb">
                                            <a href="{{ $settings->play_store_link ?? 'https://play.google.com/store' }}" target="_blank" class="stretched-link">
                                                <img src="{{ url('assets/frontend/images/footer/play.png') }}" alt="playstore-icon">
                                            </a>
                                        </div>
                                        <div class="footer__app-content">
                                            <span>GET IT ON</span>
                                            <p class="mb-0">Google Play</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-2 col-sm-4 col-6">
                        <div class="footer__links">
                            <h6>Quick links</h6>
                            <ul class="footer__linklist">
                                <li><a href="{{ route('about.index') }}" wire:navigate>About Us</a></li>
                                <li><a href="#" wire:navigate>Teams</a></li>
                                <li><a href="{{ route('service.index') }}" wire:navigate>Services</a></li>
                                <li><a href="#">Features</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Support Links -->
                    <div class="col-md-2 col-sm-4 col-6">
                        <div class="footer__links">
                            <h6>Support</h6>
                            <ul class="footer__linklist">
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">FAQs</a></li>
                                <li><a href="#">Support Center</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Company Links -->
                    <div class="col-md-2 col-sm-4">
                        <div class="footer__links">
                            <h6>Company</h6>
                            <ul class="footer__linklist">
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Updates</a></li>
                                <li><a href="#">Job</a></li>
                                <li><a href="#">Announce</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="footer__bottom">
                <div class="footer__end d-flex justify-content-between align-items-center">
                    <div class="footer__end-copyright">
                        <p class="mb-0">
                            © {{ now()->year }} All Rights Reserved.
                            {{ $settings->copyright ?? 'By Your Company' }}
                        </p>
                    </div>
                    <ul class="social">
                        @if($settings->facebook)
                        <li><a href="{{ $settings->facebook }}" target="_blank" class="social__link"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if($settings->instagram)
                        <li><a href="{{ $settings->instagram }}" target="_blank" class="social__link"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        @if($settings->linkedin)
                        <li><a href="{{ $settings->linkedin }}" target="_blank" class="social__link"><i class="fab fa-linkedin-in"></i></a></li>
                        @endif
                        @if($settings->youtube)
                        <li><a href="{{ $settings->youtube }}" target="_blank" class="social__link"><i class="fab fa-youtube"></i></a></li>
                        @endif
                        @if($settings->twitter)
                        <li><a href="{{ $settings->twitter }}" target="_blank" class="social__link"><i class="fab fa-twitter"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__shape">
        <span class="footer__shape-item footer__shape-item--1"><img src="{{ url('assets/frontend/images/footer/1.png') }}" alt="shape icon"></span>
        <span class="footer__shape-item footer__shape-item--2"><span></span></span>
    </div>
</footer>