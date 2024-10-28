@extends('layouts.app')

@section('content')
    <main class="w-full h-screen bg-white xl:grid xl:grid-cols-7 xl:grid-rows-1 flex flex-col">
        <div class="xl:col-span-1 w-full h-auto xl:h-full flex flex-col">
            <x-sidebar />
        </div>
        <div class="xl:col-span-6 w-full h-full flex flex flex-col">
            @yield('content-dashboard')
        </div>
    </main>
    @stack('scripts')
@endsection
