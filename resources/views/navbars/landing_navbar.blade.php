<!-- ========================= header-6 start ========================= -->
<header class="header header-6">
    <div class="navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        @auth('web')
                            <a class="navbar-brand" href="{{ route('peserta.beranda') }}">
                                <b>Kominfo Academy</b>
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
                                        <a class="page-scroll" href="{{ route('peserta.beranda') }}#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{ route('peserta.beranda') }}#baru">Baru</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{ route('peserta.beranda') }}#pelatihan">Pelatihan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{ route('riwayat.index') }}">Riwayat</a>
                                    </li>
                                    <li class="nav-item">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="#"
                                                onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                    class="mdi mdi-logout text-muted f-16 align-midle me-1"></i><span
                                                    class="align-midle" data-key="t-logout">Logout</span></a>
                                        </form>
                                    </li>
                                    <li class="nav-item">
                                        <div class="dropdown header-item topbar-user">
                                            <button type="button" class="btn material-shadow-none"
                                                id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="d-flex align-items-center">
                                                    <span class="text-start ms-sm-2">
                                                        <span
                                                            class="d-none d-sm-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->peserta_name }}</span>
                                                    </span>
                                                </span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- item-->
                                                <h6 class="dropdown-header">Welcome {{ Auth::user()->peserta_name }}!</h6>
                                                <a class="dropdown-item" href="{{ route('akun.akun') }}"><i
                                                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                                    <span class="align-middle">Profile</span></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <b>Kominfo Academy</b>
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
                                        <a class="page-scroll" href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="/auth-google-redirect">Login</a>
                                    </li>
                                </ul>
                            </div>
                        @endauth
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
