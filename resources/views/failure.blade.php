@extends('layouts.main')

@section('title', 'Beranda')

@push('styles')
    {{-- custom style --}}
    @vite('resources/css/beranda.css')

    {{-- AOS css --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pembayaran Gagal</div>
                <div class="card-body text-center">
                    <i class="fas fa-times-circle text-danger mb-4" style="font-size: 5rem;"></i>
                    <h3>Pembayaran Gagal</h3>
                    <p>Silakan coba lagi atau hubungi tim support kami.</p>
                    {{-- <a href="{{ route('campaign.slug', $campaign->slug) }}" class="btn btn-primary">
                        Kembali ke Campaign
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection