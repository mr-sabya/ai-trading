<header class="header-section {{ Route::is('home.index') ? 'header-section--style2' : 'bg-color-3' }}">
    <div class="header-bottom">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="{{ route('home.index')}}" wire:navigate>
                        <img class="dark" src="{{ url('assets/frontend/images/logo/logo.png') }}" alt="logo">
                    </a>
                </div>
                <div class="menu-area">
                    <ul class="menu menu--style1">
                        <li>
                            <a href="{{ route('home.index')}}" wire:navigate>Home</a>
                        </li>
                        <li>
                            <a href="{{ route('service.index') }}" wire:navigate>Services</a>

                        </li>
                        <li>
                            <a href="{{ route('about.index') }}" wire:navigate>About</a>
                        </li>

                        <li>
                            <a href="{{ route('package.index') }}" wire:navigate>Packages</a>
                        </li>
                        <li>
                            <a href="{{ route('contact.index') }}" wire:navigate>Contact Us</a>
                        </li>
                    </ul>

                </div>
                <div class="header-action">
                    <div class="menu-area">
                        <div class="header-btn">
                            <a href="{{ route('register') }}" wire:navigate class="trk-btn trk-btn--border trk-btn--primary">
                                <span>Join Now</span>
                            </a>
                        </div>

                        <!-- toggle icons -->
                        <div class="header-bar d-lg-none header-bar--style1">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>