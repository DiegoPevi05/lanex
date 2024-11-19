@extends('layouts.app')

@section('content')
    <x-navbar /> <!-- Include the Navbar component -->

    <main class="w-full h-auto bg-white">
        @yield('content-client') <!-- Inject content from specific views -->
    </main>

    <x-footer />
    @stack('scripts')
@endsection
