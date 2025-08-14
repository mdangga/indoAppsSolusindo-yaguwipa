@extends('layouts.auth')

@section('title', 'Pulihkan Akun')

@push('styles')
    {{-- custom style --}}
    @vite('resources/css/restore.css')
@endpush

@section('content')
    <div class="flex min-h-screen items-center justify-center p-6">
        <div class="max-w-md w-full glass-card">
            <div class="text-center mb-8">
                <img class="mx-auto h-24 w-auto" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}"
                    alt="logo yayasan" />
            </div>
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">
                Pulihkan Akun Anda
            </h2>

            @if ($errors->any())
                <div class="mb-4 bg-red-500/20 border border-red-400 text-red-200 px-4 py-3 rounded">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-500/20 border border-red-400 text-red-200 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form class="space-y-4" action="{{ route('profile.restore') }}" method="POST">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                    <input id="username" name="username" type="text" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300/30 rounded-md shadow-sm bg-white/10 text-gray-900 placeholder-gray-300 focus:ring-purple-400 focus:border-purple-400">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300/30 rounded-md shadow-sm bg-white/10 text-gray-900 placeholder-gray-300 focus:ring-purple-400 focus:border-purple-400">
                </div>

                <button type="submit"
                    class="w-full py-2 px-4 rounded-md text-gray-900 font-medium bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-500 hover:opacity-90 shadow-lg transition-all duration-300">
                    Pulihkan Akun
                </button>
            </form>
        </div>
    </div>
@endsection
