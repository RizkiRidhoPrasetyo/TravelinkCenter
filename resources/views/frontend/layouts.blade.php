<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travelinkcenter</title>
    <link rel="icon" href="/assets/images/TravelinkCenter.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/assets/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/assets/images/TravelinkCenter.png" alt="TravelinkCenter Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/"
                            style="background-color: {{ request()->is('/') ? '#ff7f00' : 'transparent' }}; color: {{ request()->is('/') ? 'white' : 'inherit' }}; 
                            border-radius: 10px; padding: 5px 10px; border: {{ request()->is('/') ? '2px solid #2D2766' : 'none' }};">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('top-destinations') ? 'active' : '' }}" href="{{ route('top-destinations') }}"
                            style="background-color: {{ request()->is('top-destinations') ? '#E87817' : 'transparent' }}; color: {{ request()->is('top-destinations') ? 'white' : 'inherit' }}; 
                            border-radius: 10px; padding: 5px 10px; border: {{ request()->is('top-destinations') ? '2px solid #2D2766' : 'none' }};">Top Destination</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('top-deals') ? 'active' : '' }}" href="{{ route('top-deals') }}"
                            style="background-color: {{ request()->is('top-deals') ? '#E87817' : 'transparent' }}; color: {{ request()->is('top-deals') ? 'white' : 'inherit' }}; 
                            border-radius: 10px; padding: 5px 10px; border: {{ request()->is('top-deals') ? '2px solid #2D2766' : 'none' }};">Top Deals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('travelinkclub') ? 'active' : '' }}" href="{{ route('travelinkclub') }}"
                            style="background-color: {{ request()->is('travelinkclub') ? '#ff7f00' : 'transparent' }}; color: {{ request()->is('travelinkclub') ? 'white' : 'inherit' }}; border-radius: 10px; padding: 5px 10px; border: {{ request()->is('travelinkclub') ? '2px solid #2D2766' : 'none' }};">Travelink Club</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('lifestyle') ? 'active' : '' }}" href="{{ route('lifestyle') }}"
                            style="background-color: {{ request()->is('lifestyle') ? '#E87817' : 'transparent' }}; color: {{ request()->is('lifestyle') ? 'white' : 'inherit' }}; 
                            border-radius: 10px; padding: 5px 10px; border: {{ request()->is('lifestyle') ? '2px solid #2D2766' : 'none' }};">Lifestyle</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer Section -->
    <footer class="container-fluid bg-dark text-white py-3"> <!-- Reduced py-5 to py-3 for less vertical padding -->
    {{-- <!-- Floating Translate Button -->
    <div style="position: fixed; bottom: 30px; left: 30px; z-index: 9999;">
        <div class="dropdown">
            <button class="btn btn-primary rounded-circle shadow-lg dropdown-toggle" type="button" id="translateDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 56px; height: 56px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="bi bi-translate"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="translateDropdown">
                <li><a class="dropdown-item" href="?lang=id">Bahasa Indonesia</a></li>
                <li><a class="dropdown-item" href="?lang=en">English</a></li>
            </ul>
        </div>
    </div> --}}
        <div class="row">
            <div class="col-md-4">
                <h5 class="text-uppercase">Our Social Media</h5>
                <a href="https://www.instagram.com/travelinkcenter" class="text-white me-3" target="_blank">
                    <img src="{{ asset('assets/images/instagram.png') }}" alt="Instagram" style="width: 24px; height: 24px;">
                </a> <!-- Added Instagram icon -->
                <a href="https://wa.me/0895366515139" class="text-white me-3" target="_blank">
                    <img src="{{ asset('assets/images/whatsapp.png') }}" alt="WhatsApp" style="width: 24px; height: 24px;">
                </a> <!-- Added WhatsApp icon -->
                <a href="https://www.tiktok.com/@travelinkcenter" class="text-white" target="_blank">
                    <img src="{{ asset('assets/images/tiktok.png') }}" alt="TikTok" style="width: 24px; height: 24px;">
                </a> <!-- Added TikTok icon -->
            </div>
            <div class="col-md-4">
                <h5 class="text-uppercase">Back to</h5>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-white">Home</a></li>
                    <li><a href="{{ route('top-destinations') }}" class="text-white">Top Destination</a></li>
                    <li><a href="{{ route('top-deals') }}" class="text-white">Top Deals</a></li>
                    <li><a href="{{ route('travelinkclub') }}" class="text-white">Travelink Club</a></li>
                    <li><a href="{{ route('lifestyle') }}" class="text-white">Lifestyle</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="background-color: #FFC247; border-radius: 10px;">
                    <h5 class="text-uppercase fw-bold">Penilaian Kinerja </h5>
                    <p>-</p>
                    <form class="d-flex" action="https://docs.google.com/forms/d/e/1FAIpQLSfIQ_w5n7Qbu_-Gl2MBT7bgErEHHA2srKQAr47iPnMwnAMyQQ/viewform?usp=sharing&ouid=111930626122547914321" method="get" target="_blank"> <!-- Updated to redirect to Google Form -->
                        <input type="text" class="form-control me-2" placeholder="Tekan button berikut ini" style="border-radius: 20px 0 0 20px;">
                        <button type="submit" class="btn btn-dark" style="border-radius: 0 20px 20px 0;">Isi Form</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col text-center">
                <p class="mb-0">&copy; 2025 Travelink Center. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- <!-- Bootstrap JS & Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> --}}
</body>

</html>