<header class="header-section {{ Route::is('home.index') ? 'header-section--style2' : 'bg-color-3' }}">
    <div class="header-bottom">
        <div class="container">
            <div class="header-wrapper">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{ route('home.index') }}" wire:navigate>
                        <img class="dark"
                            src="{{ $settings->light_logo ? asset('storage/' . $settings->light_logo) : url('assets/frontend/images/logo/logo.png') }}"
                            alt="{{ $settings->website_name ?? 'Website' }}">
                    </a>
                </div>

                <!-- Main Menu -->
                <div class="menu-area">
                    <ul class="menu menu--style1">
                        <li>
                            <a href="{{ route('home.index') }}" wire:navigate class="{{ Route::is('home.index') ? 'active' : '' }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('service.index') }}" wire:navigate class="{{ Route::is('service.index') ? 'active' : '' }}">Services</a>
                        </li>
                        <li>
                            <a href="{{ route('about.index') }}" wire:navigate class="{{ Route::is('about.index') ? 'active' : '' }}">About</a>
                        </li>
                        <li>
                            <a href="{{ route('package.index') }}" wire:navigate class="{{ Route::is('package.index') ? 'active' : '' }}">Packages</a>
                        </li>
                        <li>
                            <a href="{{ route('contact.index') }}" wire:navigate class="{{ Route::is('contact.index') ? 'active' : '' }}">Contact Us</a>
                        </li>
                    </ul>
                </div>

                <!-- Header Action -->
                <div class="header-action">
                    <div class="header-btn">
                        @guest
                        <a href="{{ route('register') }}" wire:navigate class="trk-btn trk-btn--border trk-btn--primary">
                            <span>Join Now</span>
                        </a>
                        @else
                        <div class="dropdown">
                            <button class="trk-btn trk-btn--border trk-btn--primary dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userMenuButton">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.index') }}" wire:navigate>Dashboard</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}" wire:navigate>Profile</a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <livewire:frontend.auth.logout />
                                </li>
                            </ul>
                        </div>
                        @endguest
                    </div>

                    <!-- Mobile toggle -->
                    <div class="header-bar d-lg-none header-bar--style1">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>