<footer class="footer">
    <div class="container-fluid d-flex justify-content-between flex-wrap">
        <!-- Left Nav Links -->
        <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ $settings->website_url ?? '#' }}">
                        {{ $settings->website_name ?? 'Website' }}
                    </a>
                </li>
                @if($settings->help_url ?? false)
                <li class="nav-item">
                    <a class="nav-link" href="{{ $settings->help_url }}">Help</a>
                </li>
                @endif
                @if($settings->license_url ?? false)
                <li class="nav-item">
                    <a class="nav-link" href="{{ $settings->license_url }}">Licenses</a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</footer>