<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <title>
        {{ $settings->website_name ?? 'MyWebsite' }} - {{ $settings->tagline ?? 'Your Trusted Partner in Trading and Investments' }}
    </title>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Sites meta Data -->
    <meta name="application-name"
        content="Bitrader - Professional Multipurpose HTML Template for Your Crypto, Forex, Stocks & Day Trading Business">
    <meta name="author" content="thetork">
    <meta name="keywords" content="Bitrader, Crypto, Forex, and Stocks Trading Business">
    <meta name="description"
        content="Experience the power of Bitrader, the ultimate HTML template designed to transform your trading business. With its sleek design and advanced features, Bitrader empowers you to showcase your expertise, engage clients, and dominate the markets. Elevate your online presence and unlock new trading possibilities with Bitrader.">

    <!-- OG meta data -->
    <meta property="og:title"
        content="Bitrader - Professional Multipurpose HTML Template for Your Crypto, Forex, Stocks & Day Trading Business">
    <meta property="og:site_name" content=Bitrader>
    <meta property="og:url" content="index.html">
    <meta property="og:description"
        content="Welcome to Bitrader, the game-changing HTML template meticulously crafted to revolutionize your trading business. With its sleek and modern design, Bitrader provides a cutting-edge platform to showcase your expertise, attract clients, and stay ahead in the competitive trading markets.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="assets/images/og.png">



    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/swiper-bundle.min.css') }}">



    <!-- main css for template -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">

    @livewireStyles
</head>

<body>

    <!-- ===============>> Preloader start here <<================= -->
    <div
        x-data="{ loading: true }"
        x-init="
        if (sessionStorage.getItem('preloaderShown')) {
            loading = false;
        } else {
            window.addEventListener('load', () => {
                setTimeout(() => {
                    loading = false;
                    sessionStorage.setItem('preloaderShown', 'true');
                }, 1500); // adjust timing if needed
            });
        }
    ">
        <!-- Start Preloader -->
        <div class="preloader"
            x-show="loading"
            x-transition.opacity.duration.500ms>
            <img src="{{ url('assets/frontend/images/logo/preloader.png') }}" alt="preloader icon">
        </div>
        <!-- End Preloader -->
    </div>


    <!-- ===============>> Preloader end here <<================= -->



    <!-- ===============>> light&dark switch start here <<================= -->
    <div class="lightdark-switch" style="display: none;">
        <span class="switch-btn" id="btnSwitch"><img src="{{ url('assets/frontend/images/icon/moon.svg') }}" alt="light-dark-switchbtn"
                class="swtich-icon"></span>
    </div>
    <!-- ===============>> light&dark switch start here <<================= -->


    <!-- ===============>> Header section start here <<================= -->
    <livewire:frontend.theme.header />
    <!-- ===============>> Header section end here <<================= -->



    @yield('content')


    <!-- ===============>> footer start here <<================= -->
    <livewire:frontend.theme.footer />
    <!-- ===============>> footer end here <<================= -->



    <!-- ===============>> scrollToTop start here <<================= -->
    <a href="#" class="scrollToTop scrollToTop--style1"><i class="fa-solid fa-arrow-up-from-bracket"></i></a>
    <!-- ===============>> scrollToTop ending here <<================= -->


    <!-- vendor plugins -->

    <script data-navigate-once src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/all.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/swiper-bundle.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/aos.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/fslightbox.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/purecounter_vanilla.js') }}"></script>



    <script data-navigate-once src="{{ asset('assets/frontend/js/custom.js') }}"></script>

    @livewireScripts

</body>



</html>