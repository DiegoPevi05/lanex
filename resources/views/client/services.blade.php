@section('title', 'Servicios de Transporte Internacional y Aduanas | LanEx')
@section('meta_description', __('messages.meta.services'))
@extends('layouts.client')


@section('content-client')
    <section id="services_hero_section" data-enter class="w-full flex flex-col min-h-[85svh] lg:min-h-[90svh] pt-[160px] xl:pt-[190px] pb-24 relative z-10 text-white overflow-hidden bg-slate-950">
        <!-- Photographic Ground with High Visibility -->
        <img src="{{ asset('storage/images/web/services.webp') }}" alt="{{ __('Servicios Logísticos LanEx') }}" class="hero-enter-media w-full h-full absolute inset-0 object-cover opacity-55">
        <!-- Balanced Protective Dark Gradient Overlays for Guaranteed Text Legibility -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-primary-dark/45 z-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary/35 via-transparent to-transparent z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-20 w-full my-auto flex flex-col justify-center">
            <div class="max-w-3xl flex flex-col items-start gap-4">
                <span class="hero-enter-item text-xs sm:text-sm font-bold uppercase tracking-widest text-purple-400 block">
                    {{ __('messages.services.header') }}
                </span>
                <h1 class="hero-enter-item text-3xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight sm:leading-none font-display">
                    {{ __('messages.services.title') }}
                </h1>
                <p class="hero-enter-item text-base sm:text-lg text-slate-300 font-normal leading-relaxed mt-2 max-w-2xl">
                    {{ __('messages.services.subheader') }}
                </p>

                <div class="hero-enter-item flex flex-wrap items-center gap-4 mt-6">
                    <a href="{{ route('quote') }}" class="taste-btn inline-flex items-center gap-2 h-12 px-6 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm shadow-lg shadow-primary/25 group">
                        <span>{{ __('Solicitar Cotización de Carga') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('track') }}" class="taste-btn inline-flex items-center gap-2 h-12 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm border border-white/20">
                        <span>{{ __('Rastrear Guía / Contenedor') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <x-brands  title="{{ __('messages.service.brands.title') }}" variant='secondary' :suppliers="$suppliers"/>
    <x-content-section
        header="{{ __('messages.services.content.header') }}"
        title="{{ __('messages.services.content.title') }}"
        svgContent="images/web/statistics.svg"
        introduction="{{ __('messages.services.content.introduction') }}"
        content1="{{ __('messages.services.content.content1') }}"
        content2="{{ __('messages.services.content.content2') }}"
    />
    <x-content-link-section
        header="{{ __('messages.services.link_section.header') }}"
        title="{{ __('messages.services.link_section.title') }}"
        svgContent="images/web/truck_delivery.svg"
        button="{{ __('messages.services.link_section.button') }}"
        content="{{ __('messages.services.link_section.content') }}"
        href="{{ route('quote') }}"
    />
    <x-calculator-shipping />
    <x-services-section />
    <x-blogs-carousel :blogs="$blogs" />
@endsection
