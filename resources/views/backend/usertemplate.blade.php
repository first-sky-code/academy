<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('nova/css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('nova/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('nova/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('nova/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('nova/css/lindy-uikit.css') }}" />
    @yield('head')
</head>

<body>
    @yield('content')
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================= preloader end ========================= -->
    {{-- Navbar --}}
    {{-- <x-backend.navbar></x-backend.navbar> --}}
    {{-- Navbar End --}}



    <!-- ========================= scroll-top start ========================= -->
    <a href="#" class="scroll-top"> <i class="lni lni-chevron-up"></i> </a>
    <!-- ========================= scroll-top end ========================= -->


    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('nova/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('nova/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('nova/js/wow.min.js') }}"></script>
    <script src="{{ asset('nova/js/main.js') }}"></script>
</body>

</html>
