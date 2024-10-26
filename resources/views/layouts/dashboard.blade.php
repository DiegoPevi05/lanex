@extends('layouts.app')

@section('content')
    <main class="w-full min-h-screen xl:h-screen bg-white flex xl:grid xl:grid-cols-7 xl:grid-rows-1  flex-col">
        <x-toast/>
        <div class="xl:col-span-1 w-full h-auto xl:h-full flex flex-col">
            <x-sidebar />
        </div>
        <div class="xl:col-span-6 w-full h-full flex flex flex-col">
            @yield('content-dashboard')
        </div>
    </main>
    @stack('scripts')
@endsection
