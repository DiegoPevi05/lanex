@extends('layouts.app')

@section('content')
    <main class="w-full h-screen bg-white grid grid-cols-7 grid-rows-1">
        <div class="col-span-1 w-full h-full flex flex-col">
            <x-sidebar />
        </div>
        <div class="col-span-6 w-full h-full flex flex flex-col">
            @yield('content-dashboard')
        </div>
    </main>
@endsection
