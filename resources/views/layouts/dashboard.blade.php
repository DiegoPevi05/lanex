@section('robots', 'noindex, nofollow, noarchive')
@section('title', 'Panel de Control | LanEx')
@extends('layouts.app')

@section('content')
    <main class="w-full h-screen bg-slate-50 flex flex-col xl:flex-row overflow-hidden">
        <div class="w-full xl:w-64 shrink-0 h-auto xl:h-full flex flex-col">
            <x-sidebar />
        </div>
        <div class="flex-1 min-w-0 w-full h-full flex flex-col overflow-hidden">
            @yield('content-dashboard')
        </div>
    </main>
    @stack('scripts')
@endsection
