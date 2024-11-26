@extends('layouts.app')

@section('content')
<div class="w-full h-screen bg-secondary flex flex-col items-center justify-center">
        <div class="w-auto h-auto flex flex-row items-center mb-6">
            <div class="w-[60px] h-auto p-none">
                <img src="/images/logo.png" alt="logo" class="h-auto w-full" />
            </div>
            <div class="w-auto flex flex-row">
                <h1 class="font-bold text-primary">
                    Lan
                </h1>
                <h1 class="font-bold text-primary-dark">
                    Ex
                </h1>
            </div>
        </div>
        <h3 class="font-bold text-primary-dark">404 - Page Not Found</h3>
        <p class="font-bold text-primary-dark">Sorry, the page you are looking for could not be found.</p>
        <x-button leftIcon="heroicon-s-arrow-left" rightIcon="heroicon-s-home" text="" url="{{ route('home') }}" size="lg" extraClasses="uppercase font-bold mt-6"/>
</div>
@endsection
