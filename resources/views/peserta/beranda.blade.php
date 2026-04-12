@extends('backend.usertemplate')
@section('title', 'Beranda')
@section('content')
    <!-- ========================= hero-section-wrapper-5 start ========================= -->
    <section id="home" class="hero-section-wrapper-5">

        @include('navbars.landing_navbar')

        <!-- ========================= hero-5 start ========================= -->
        <div class="hero-section hero-style-5 img-bg"
            style="background-image: url('{{ asset('nova/img/hero/hero-5/hero-bg.svg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero-content-wrapper">
                            <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">Telah Dibuka Pelatihan Class Junior!
                            </h2>
                            <p class="mb-30 wow fadeInUp" data-wow-delay=".4s">Berminat? Segera ikuti
                                pelatihan kami!</p>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-end">
                        <div class="hero-image wow fadeInUp" data-wow-delay=".5s">
                            <img src="{{ asset('nova/img/hero/hero-5/hero-img.svg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========================= hero-5 end ========================= -->

    </section>
    <!-- ========================= hero-section-wrapper-6 end ========================= -->

    <!-- ========================= about style-4 start ========================= -->
    <section id="baru" class="about-section about-style-5" style="scroll-margin-top: 90px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="about-content-wrapper">
                        <div class="section-title mb-30">
                            <h3 class="mb-25 wow fadeInUp" data-wow-delay=".2s">PENDEKAR Class Junior Telah Hadir!
                            </h3>
                            <p class="wow fadeInUp" data-wow-delay=".3s">Ayo isi liburan dengan kegiatan yang menyenangkan
                                dan edukatif!</p>
                        </div>
                        <ul>
                            <li class="wow fadeInUp" data-wow-delay=".35s">
                                <i class="lni lni-checkmark-circle"></i>
                                Peserta akan mendapatkan pelatihan dengan materi yang menarik dan bermanfaat untuk
                                meningkatkan keterampilan di bidang teknologi informasi.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".4s">
                                <i class="lni lni-checkmark-circle"></i>
                                Akan mendapatkan sertifikat pelatihan yang dapat meningkatkan nilai jual di dunia kerja di
                                bidang teknologi informasi.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".45s">
                                <i class="lni lni-checkmark-circle"></i>
                                Pendaftarannya mudah dan GRATIS! Jangan lewatkan kesempatan ini untuk meningkatkan
                                keterampilan di bidang teknologi informasi.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="about-image text-lg-right wow fadeInUp" data-wow-delay=".5s">
                        <img src="{{ asset('nova/img/poster.jpeg') }}" style="width: 80%" class="rounded shadow"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= about style-4 end ========================= -->

    <!-- ========================= feature style-5 start ========================= -->
    <section id="pelatihan" class="feature-section feature-style-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-8">
                    <div class="section-title text-center mb-60">
                        <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">List Pelatihan</h3>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Silahkan Ikuti Pelatihan yang Tersedia</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($pelatihan as $item)
                    <div class="col-lg-4 col-md-6">

                        <a href="{{ route('pendaftaran.index', $item->pelatihan_id) }}">
                            <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                                <div class="icon">
                                    <i class="lni lni-vector"></i>
                                    <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                            fill="#EBF4FF" />
                                    </svg>
                                </div>
                                <div class="content">
                                    <h5>{{ $item->pelatihan_name }}</h5>
                                    <p>Silahkan Daftar Disini!</p>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <div class="icon">
                            <i class="lni lni-pallet"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Print Design</h5>
                            <p>Coming Soon...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <div class="icon">
                            <i class="lni lni-stats-up"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Business Analysis</h5>
                            <p>Coming Soon...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon">
                            <i class="lni lni-code-alt"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Web Development</h5>
                            <p>Coming Soon...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <div class="icon">
                            <i class="lni lni-lock"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Best Security</h5>
                            <p>Coming Soon...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <div class="icon">
                            <i class="lni lni-code"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Web Design</h5>
                            <p>Coming Soon...</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ========================= feature style-5 end ========================= -->

    <!-- ========================= footer style-4 start ========================= -->
    <footer class="footer footer-style-4">
        <div class="container">
            <div class="widget-wrapper">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget wow fadeInUp" data-wow-delay=".2s">
                            <div class="logo">
                                <a href="#0"> <img src="{{ asset('nova/img/logo/logo.svg') }}" alt=""> </a>
                            </div>
                            <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Facilisis nulla
                                placerat amet amet congue.</p>
                            <ul class="socials">
                                <li> <a href="#0"> <i class="lni lni-facebook-filled"></i> </a> </li>
                                <li> <a href="#0"> <i class="lni lni-twitter-filled"></i> </a> </li>
                                <li> <a href="#0"> <i class="lni lni-instagram-filled"></i> </a> </li>
                                <li> <a href="#0"> <i class="lni lni-linkedin-original"></i> </a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget wow fadeInUp" data-wow-delay=".3s">
                            <h6>Quick Link</h6>
                            <ul class="links">
                                <li> <a href="#0">Home</a> </li>
                                <li> <a href="#0">About</a> </li>
                                <li> <a href="#0">Service</a> </li>
                                <li> <a href="#0">Testimonial</a> </li>
                                <li> <a href="#0">Contact</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget wow fadeInUp" data-wow-delay=".4s">
                            <h6>Services</h6>
                            <ul class="links">
                                <li> <a href="#0">Web Design</a> </li>
                                <li> <a href="#0">Web Development</a> </li>
                                <li> <a href="#0">Seo Optimization</a> </li>
                                <li> <a href="#0">Blog Writing</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-widget wow fadeInUp" data-wow-delay=".5s">
                            <h6>Download App</h6>
                            <ul class="download-app">
                                <li>
                                    <a href="#0">
                                        <span class="icon"><i class="lni lni-apple"></i></span>
                                        <span class="text">Download on the <b>App Store</b> </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#0">
                                        <span class="icon"><i class="lni lni-play-store"></i></span>
                                        <span class="text">GET IT ON <b>Play Store</b> </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-wrapper wow fadeInUp" data-wow-delay=".2s">
                <p>Design and Developed by <a href="https://uideck.com" rel="nofollow" target="_blank">UIdeck</a>
                    Built-with <a href="https://uideck.com" rel="nofollow" target="_blank">Lindy UI Kit</a>.
                    Distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
            </div>
        </div>
    </footer>
    <!-- ========================= footer style-4 end ========================= -->
@endsection
