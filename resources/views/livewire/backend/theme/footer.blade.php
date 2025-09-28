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

        <!-- Center Copyright -->
        <div class="copyright text-center">
            {{ date('Y') }}, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="{{ $settings->author_url ?? '#' }}">
                {{ $settings->author_name ?? 'Sabya Roy' }}
            </a>
        </div>

        <!-- Right Distributed By -->
        @if($settings->distributed_by ?? false)
        <div class="text-end">
            Distributed by
            <a target="_blank" href="{{ $settings->distributed_url ?? '#' }}">
                {{ $settings->distributed_by }}
            </a>.
        </div>
        @endif
    </div>
</footer>