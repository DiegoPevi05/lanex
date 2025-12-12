@extends('layouts.app')

@section('content')
    <x-navbar /> <!-- Include the Navbar component -->

    <main class="w-full h-auto bg-white flex flex-col">
        @yield('content-client') <!-- Inject content from specific views -->
        <x-whatsapp-button/>
    </main>

    <x-footer />
    @stack('scripts')
@endsection
