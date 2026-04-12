<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">


<!-- Mirrored from themesbrand.com/velzon/html/master/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:46:57 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Academy - @yield('title', 'Beranda')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="icon" type="image/png" href="{{ asset('nova/img/logo3.png') }}">
    <!-- swiper slider css -->
    <link href="{{ asset('velzon/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />

    <!-- plugin css -->
    <link href="{{ asset('velzon/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('velzon/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('velzon/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('velzon/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('velzon/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('velzon/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- Summernote --}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    @yield('head')

</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Firsky.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Firsky
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Theme Settings -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('velzon/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('velzon/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('velzon/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('velzon/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('velzon/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('velzon/js/plugins.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <!-- apexcharts -->
    <script src="{{ asset('velzon/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Swiper Js -->
    <script src="{{ asset('velzon/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- CRM js -->
    <script src="{{ asset('velzon/js/pages/dashboard-crypto.init.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('velzon/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('velzon/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('velzon/js/pages/dashboard-analytics.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('velzon/js/app.js') }}"></script>

    <!-- prismjs plugin -->
    <script src="{{ asset('velzon/libs/prismjs/prism.js') }}"></script>

    <script src="{{ asset('velzon/js/pages/form-validation.init.js') }}"></script>

    {{-- @yield('jquery')
    <script>
        $('button.modalTest').click(function() {
            $('#fadeInRightModal').modal('show');
            id = $(this).attr('id');
            $.get("{{ route('test.modal') }}", {
                id: id
            }, function(data) {
                $('div.body-modal').html(data);
            });
        });
    </script>
    @include('sweetalert::alert') --}}
</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:46:57 GMT -->

</html>
