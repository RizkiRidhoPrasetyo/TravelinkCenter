@extends('frontend.layouts')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-4">
                <h1 class="display-5 fw-bold">Paket Travel</h1>
                <p class="lead">Semua daftar paket travel yang kami sediakan.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @forelse ($packages as $package)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/images/' . $package->image) }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="{{ $package->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $package->title }}</h5>
                            <p class="card-text">{{ Str::limit($package->description, 80) }}</p>
                        </div>
                        <div class="card-footer bg-white border-0 text-center">
                            <a href="{{ route('travel.single', $package->id) }}" class="btn btn-primary w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Tidak ada paket travel yang tersedia.</p>
                </div>
            @endforelse
        </div>
        <!-- Tambahan 4 card dummy mirip package tour di home -->
        <div class="row mt-4">
            @for ($i = 1; $i <= 4; $i++)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('frontend/assets/images/bunga.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Paket Tour">
                        <div class="card-body">
                            <h5 class="card-title">Paket Tour Spesial {{ $i }}</h5>
                            <p class="card-text">Nikmati pengalaman wisata terbaik bersama kami di destinasi pilihan.</p>
                        </div>
                        <div class="card-footer bg-white border-0 text-center">
                            <a href="#" class="btn btn-outline-primary w-100 disabled">Segera Hadir</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Tidak ada fitur like, comment, atau rating pada tampilan ini -->
@endsection