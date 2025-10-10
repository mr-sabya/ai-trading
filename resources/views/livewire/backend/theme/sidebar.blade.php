<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" wire:navigate class="logo">
                <img
                    src="{{ $settings->light_logo ? asset('storage/'.$settings->light_logo) : url('assets/backend/img/kaiadmin/logo_light.svg') }}"
                    alt="{{ $settings->website_name ?? 'Dashboard' }}"
                    class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" wire:navigate>
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Settings</h4>
                </li>

                <li class="nav-item {{ Request::routeIs('admin.settings.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#settingsMenu" aria-expanded="{{ Request::routeIs('admin.settings.*') ? 'true' : 'false' }}">
                        <i class="fas fa-cog"></i>
                        <p>Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('admin.settings.*') ? 'show' : '' }}" id="settingsMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::routeIs('admin.settings.site-info') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.site-info') }}" wire:navigate>
                                    <span class="sub-item">Site Info</span>
                                </a>
                            </li>
                            <li class="{{ Request::routeIs('admin.settings.logos') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.logos') }}" wire:navigate>
                                    <span class="sub-item">Logos & Favicon</span>
                                </a>
                            </li>
                            <li class="{{ Request::routeIs('admin.settings.social-links') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.social-links') }}" wire:navigate>
                                    <span class="sub-item">Social Links</span>
                                </a>
                            </li>
                            <li class="{{ Request::routeIs('admin.settings.seo') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.seo') }}" wire:navigate>
                                    <span class="sub-item">SEO</span>
                                </a>
                            </li>
                            <li class="{{ Request::routeIs('admin.settings.additional') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.additional') }}" wire:navigate>
                                    <span class="sub-item">Additional Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::routeIs('admin.user.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#userMenu" aria-expanded="{{ Request::routeIs('admin.user.*') ? 'true' : 'false' }}">
                        <i class="fas fa-cog"></i>
                        <p>Users</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('admin.user.*') ? 'show' : '' }}" id="userMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::routeIs('admin.user.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.user.index') }}" wire:navigate>
                                    <span class="sub-item">Users List</span>
                                </a>
                            </li>
                            <li class="{{ Request::routeIs('admin.user.create') ? 'active' : '' }}">
                                <a href="{{ route('admin.user.create') }}" wire:navigate>
                                    <span class="sub-item">Add User</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::routeIs('admin.website.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#websiteMenu" aria-expanded="{{ Request::routeIs('admin.website.*') ? 'true' : 'false' }}">
                        <i class="fas fa-cog"></i>
                        <p>Website</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('admin.website.*') ? 'show' : '' }}" id="websiteMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::routeIs('admin.website.banner.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.website.banner.index') }}" wire:navigate>
                                    <span class="sub-item">Banner</span>
                                </a>
                            </li>
                            <!-- partner -->
                            <li class="{{ Request::routeIs('admin.website.partner.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.website.partner.index') }}" wire:navigate>
                                    <span class="sub-item">Partner</span>
                                </a>
                            </li>

                            <!-- about -->
                            <li class="{{ Request::routeIs('admin.website.about.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.website.about.index') }}" wire:navigate>
                                    <span class="sub-item">About</span>
                                </a>
                            </li>

                            <!-- features -->
                            <li class="{{ Request::routeIs('admin.website.features.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.website.features.index') }}" wire:navigate>
                                    <span class="sub-item">Features</span>
                                </a>
                            </li>

                            <!-- service -->
                            <li class="{{ Request::routeIs('admin.website.service.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.website.service.index') }}" wire:navigate>
                                    <span class="sub-item">Service</span>
                                </a>
                            </li>

                            <!-- team -->
                            <li class="{{ Request::routeIs('admin.website.team.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.website.team.index') }}" wire:navigate>
                                    <span class="sub-item">Team Members</span>
                                </a>
                            </li>

                            <!-- testimonial -->
                            <li class="{{ Request::routeIs('admin.website.testimonial.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.website.testimonial.index') }}" wire:navigate>
                                    <span class="sub-item">Testimonial</span>
                                </a>
                            </li>

                            <!-- faq -->
                            <li class="{{ Request::routeIs('admin.website.faq.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.website.faq.index') }}" wire:navigate>
                                    <span class="sub-item">FAQ</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ Request::routeIs('admin.packages.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.packages.index')}}" wire:navigate>
                        <i class="fas fa-box"></i>
                        <p>Packages</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('admin.purchase.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.purchase.index')}}" wire:navigate>
                        <i class="fas fa-box"></i>
                        <p>Purchase List</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::routeIs('admin.referral-generation.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.referral-generation.index')}}" wire:navigate>
                        <i class="fas fa-sitemap"></i>
                        <p>Referral Generation</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>