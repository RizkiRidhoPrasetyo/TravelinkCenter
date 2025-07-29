@extends('frontend.layouts')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('canceled'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('canceled') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking Destinasi Wisata</div>
                <div class="card-body">
                    @if(isset($package) && $package && $package->max_quota <= 0)
                        <div class="alert alert-warning">Kuota booking untuk wisata ini sudah habis!</div>
                    @endif
                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package_id ?? '' }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No Telepon</label>
                            <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal Booking</label>
                            <input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan (opsional)</label>
                            <textarea id="notes" class="form-control" name="notes">{{ old('notes') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" @if(isset($package) && $package && $package->max_quota <= 0) onclick="alert('Kuota sudah habis!'); return false;" disabled @endif>Kirim Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
