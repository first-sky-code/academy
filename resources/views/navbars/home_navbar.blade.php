<!-- ========================= header-6 start ========================= -->
<header class="header header-6">
    <div class="navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="logo" href="{{ route('home') }}">
                            <span class="logo-sm">
                                <img src="{{ asset('nova/img/logo2.png') }}" alt="" height="25">
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent6" aria-controls="navbarSupportedContent6"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent6">
                            <ul id="nav6" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="page-scroll active" href="#home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#about">Terbaru</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#feature">List Pelatihan</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="page-scroll" href="{{ route('user.login') }}">Login</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="page-scroll" href="/auth-google-redirect">Login</a>
                                </li>
                            </ul>
                        </div>
                        <!-- navbar collapse -->
                    </nav>
                    <!-- navbar -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- navbar area -->
</header>
<!-- ========================= header-6 end ========================= -->
