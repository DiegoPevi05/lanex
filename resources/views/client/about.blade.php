@section('title', 'Nosotros | LanEx — Operador Logístico Internacional')
@section('meta_description', __('messages.meta.aboutus'))
@extends('layouts.client')

@section('content-client')
    <!-- Hero Section -->
    <section id="aboutus_hero_section" data-enter class="w-full flex flex-col min-h-[85svh] lg:min-h-[90svh] pt-[160px] xl:pt-[190px] pb-24 relative z-10 text-white overflow-hidden bg-slate-950">
        <!-- Background Image with High Photographic Visibility -->
        <img src="{{ asset('storage/images/web/aboutus.webp') }}" alt="{{ __('LanEx Operaciones Logísticas') }}" class="hero-enter-media w-full h-full absolute inset-0 object-cover opacity-55">
        <!-- Balanced Dark Overlay Gradients for Guaranteed Legibility & Backdrop Depth -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-primary-dark/45 z-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary/35 via-transparent to-transparent z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-20 w-full my-auto flex flex-col justify-center">
            <div class="max-w-3xl flex flex-col items-start gap-4">
                <span class="hero-enter-item text-xs sm:text-sm font-bold uppercase tracking-widest text-purple-400 block">
                    {{ __('messages.about.hero.header') }}
                </span>
                <h1 class="hero-enter-item text-3xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight sm:leading-none font-display">
                    {{ __('messages.about.hero.title') }}
                </h1>
                <p class="hero-enter-item text-base sm:text-lg text-slate-300 font-normal leading-relaxed mt-2 max-w-2xl">
                    {{ __('messages.about.hero.description') }}
                </p>

                <!-- Action CTAs -->
                <div class="hero-enter-item flex flex-wrap items-center gap-4 mt-6">
                    <a href="{{ route('quote') }}" class="taste-btn inline-flex items-center gap-2 h-12 px-6 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm shadow-lg shadow-primary/25 group">
                        <span>{{ __('Solicitar Asesoría Logística') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('services') }}" class="taste-btn inline-flex items-center gap-2 h-12 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm border border-white/20">
                        <span>{{ __('Ver Nuestros Servicios') }}</span>
                    </a>
                </div>

                <!-- Trust Badges with Brand Themed Icons (No Bullet Dots) -->
                <div class="hero-enter-item pt-8 border-t border-white/10 w-full grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs text-slate-200 mt-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-500/20 border border-purple-500/30 flex items-center justify-center text-purple-400 shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <span class="font-semibold text-white">{{ __('+10 Años de Experiencia') }}</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-500/20 border border-purple-500/30 flex items-center justify-center text-purple-400 shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                        </div>
                        <span class="font-semibold text-white">{{ __('Callao y Cobertura Global') }}</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-500/20 border border-purple-500/30 flex items-center justify-center text-purple-400 shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                        </div>
                        <span class="font-semibold text-white">{{ __('Agente de Carga Internacional') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section (Context sentences instead of orphaned AI bars) -->
    <section id="about_us_statistics" class="w-full bg-slate-900 text-white border-b border-slate-800 py-14 sm:py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-slate-800">
                <div class="flex flex-col items-start md:pr-8">
                    <span class="text-3xl sm:text-4xl font-bold text-purple-400 tracking-tight font-display mb-2">
                        {{ __('messages.about.statistics.stats_1_value') }}
                    </span>
                    <p class="text-base font-semibold text-white">
                        {{ __('messages.about.statistics.stats_1_label') }}
                    </p>
                    <p class="text-sm text-slate-400 mt-1 font-normal leading-relaxed">
                        {{ __('Operamos rutas marítimas y aéreas consolidadas hacia el Puerto del Callao.') }}
                    </p>
                </div>

                <div class="flex flex-col items-start pt-6 md:pt-0 md:px-8">
                    <span class="text-3xl sm:text-4xl font-bold text-purple-400 tracking-tight font-display mb-2">
                        {{ __('messages.about.statistics.stats_2_value') }}
                    </span>
                    <p class="text-base font-semibold text-white">
                        {{ __('messages.about.statistics.stats_2_label') }}
                    </p>
                    <p class="text-sm text-slate-400 mt-1 font-normal leading-relaxed">
                        {{ __('Coordinación directa con fabricantes certificados en China y Estados Unidos.') }}
                    </p>
                </div>

                <div class="flex flex-col items-start pt-6 md:pt-0 md:pl-8">
                    <span class="text-3xl sm:text-4xl font-bold text-purple-400 tracking-tight font-display mb-2">
                        {{ __('messages.about.statistics.stats_3_value') }}
                    </span>
                    <p class="text-base font-semibold text-white">
                        {{ __('messages.about.statistics.stats_3_label') }}
                    </p>
                    <p class="text-sm text-slate-400 mt-1 font-normal leading-relaxed">
                        {{ __('Equipo especialista en despacho aduanero SUNAT y transporte multimodal.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <x-pillars-section />

    <x-calculator-shipping />

    <x-content-section
        header="{{ __('messages.about.content.header') }}"
        title="{{ __('messages.about.content.title') }}"
        svgContent="images/web/aboutus_1.svg"
        introduction="{{ __('messages.about.content.introduction') }}"
        content1="{{ __('messages.about.content.content1') }}"
        content2="{{ __('messages.about.content.content2') }}"
    />

    <x-content-link-section
        header="{{ __('messages.about.content_link.header') }}"
        title="{{ __('messages.about.content_link.title') }}"
        svgContent="images/web/aboutus_2.svg"
        button="{{ __('messages.about.content_link.button_label') }}"
        content="{{ __('messages.about.content_link.content') }}"
        href="{{ route('quote') }}"
    />

    <x-services-section />

    <x-blogs-carousel :blogs="$blogs" />
@endsection
