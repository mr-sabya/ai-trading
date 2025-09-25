<header class="header-section header-section--style2">
    <div class="header-bottom">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="index-2.html">
                        <img class="dark" src="{{ url('assets/frontend/images/logo/logo.png') }}" alt="logo">
                    </a>
                </div>
                <div class="menu-area">
                    <ul class="menu menu--style1">
                        <li>
                            <a href="{{ route('home.index')}}" wire:navigate>Home</a>
                        </li>
                        <li>
                            <a href="#">Services</a>

                        </li>
                        <li>
                            <a href="#">About</a>

                        </li>

                        <li>
                            <a href="#">Pages</a>
                        </li>
                        <li>
                            <a href="contact.html">Contact Us</a>
                        </li>
                    </ul>

                </div>
                <div class="header-action">
                    <div class="menu-area">
                        <div class="header-btn">
                            <a href="signup.html" class="trk-btn trk-btn--border trk-btn--primary">
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