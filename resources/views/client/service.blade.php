@section('title', ($service->name ?? 'Servicio Logístico') . ' | LanEx')
@section('meta_description', !empty($service->description) ? Str::limit(strip_tags($service->description), 155) : __('messages.meta.service'))
@if(!empty($service->image))
@section('og_image', asset('storage/' . $service->image))
@endif
@extends('layouts.client')


@section('content-client')
    <section id="service_hero_section" data-enter class="w-full flex flex-col min-h-[80svh] lg:min-h-[85svh] pt-[160px] xl:pt-[190px] pb-24 relative z-10 text-white overflow-hidden bg-slate-950">
        @if(!empty($service['webcontent']['image']))
            <img src="{{ asset('storage/' . ltrim($service['webcontent']['image'], '/')) }}" alt="{{ $service['webcontent']['title'] ?? 'Servicio LanEx' }}" class="hero-enter-media w-full h-full absolute inset-0 object-cover opacity-55">
        @endif
        <!-- Protective Dark Gradient Overlays for Guaranteed Text Legibility -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-primary-dark/45 z-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary/35 via-transparent to-transparent z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-20 w-full my-auto flex flex-col justify-center">
            <div class="max-w-3xl flex flex-col items-start gap-4">
                @if(!empty($service['webcontent']['header']))
                    <span class="hero-enter-item text-xs sm:text-sm font-bold uppercase tracking-widest text-purple-400 block">
                        {{$service['webcontent']['header']}}
                    </span>
                @endif

                @if(!empty($service['webcontent']['title']))
                    <h1 class="hero-enter-item text-3xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight sm:leading-none font-display">
                        {{$service['webcontent']['title']}}
                    </h1>
                @endif

                @if(!empty($service['webcontent']['description']))
                    <p class="hero-enter-item text-base sm:text-lg text-slate-300 font-normal leading-relaxed mt-2 max-w-2xl">
                        {{$service['webcontent']['description']}}
                    </p>
                @endif

                <div class="hero-enter-item flex flex-wrap items-center gap-4 mt-6">
                    <a href="{{ route('quote', ['type' => 'service', 'id' => $service->id]) }}" class="taste-btn inline-flex items-center gap-2 h-12 px-6 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm shadow-lg shadow-primary/25 group">
                        <span>{{ __('Solicitar Cotización de este Servicio') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('services') }}" class="taste-btn inline-flex items-center gap-2 h-12 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm border border-white/20">
                        <span>{{ __('Ver Todos los Servicios') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if($service->suppliers->isNotEmpty())
        <x-brands  title="{{ __('messages.service.brands.title') }}" variant='secondary' :suppliers="$service->suppliers"/>
    @endif

    @if(!empty($service['webcontent']['overview']['title']) || !empty($service['webcontent']['overview']['header']))
        <x-content-section
            header="{{$service['webcontent']['overview']['header'] ?? ''}}"
            title="{{$service['webcontent']['overview']['title'] ?? ''}}"
            svgContent="{{$service['webcontent']['overview']['image'] ?? ''}}"
            introduction="{{$service['webcontent']['overview']['content']['header'] ?? ''}}"
            content1="{{$service['webcontent']['overview']['content']['introduction'] ?? ''}}"
            content2="{{$service['webcontent']['overview']['content']['content'] ?? ''}}"
        />
    @endif

    @if(!empty($service['webcontent']['content_link']['title']) || !empty($service['webcontent']['content_link']['header']))
        <x-content-link-section
            header="{{$service['webcontent']['content_link']['header'] ?? ''}}"
            title="{{$service['webcontent']['content_link']['title'] ?? ''}}"
            svgContent="{{$service['webcontent']['content_link']['image'] ?? ''}}"
            button="{{$service['webcontent']['content_link']['button_label'] ?? ''}}"
            content="{{$service['webcontent']['content_link']['content'] ?? ''}}"
            href="{{ route('quote', ['type' => 'service', 'id' => $service->id]) }}"
        />
    @endif

    @if(!empty($service['webcontent']['keypoints']['points']))
        <section id="service_key_points" class="w-full bg-slate-900 text-white py-16 sm:py-24 relative overflow-hidden border-b border-slate-800" data-scroll-title="{{ __('Modalidades') }}">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                    <div class="max-w-2xl">
                        @if(!empty($service['webcontent']['keypoints']['header']))
                            <span class="text-xs font-bold uppercase tracking-widest text-purple-400 block mb-2">
                                {{$service['webcontent']['keypoints']['header']}}
                            </span>
                        @endif
                        @if(!empty($service['webcontent']['keypoints']['title']))
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight font-display">
                                {{$service['webcontent']['keypoints']['title']}}
                            </h2>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <span>{{ __('Modalidades operativas de flete y despacho') }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($service['webcontent']['keypoints']['points'] as $index => $point)
                        <a href="{{ route('quote', ['type' => 'service', 'id' => $service->id]) }}" class="taste-card-link group relative bg-slate-950 border border-slate-800 hover:border-purple-500/60 rounded-2xl p-6 sm:p-7 hover:shadow-lg flex flex-col justify-between">
                            <div class="flex flex-col">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs font-mono font-bold text-purple-400">
                                        0{{ $index + 1 }}
                                    </span>
                                    <svg class="w-4 h-4 text-slate-500 group-hover:text-purple-300 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </div>

                                <h3 class="font-bold text-white text-lg leading-snug">
                                    {{$point['title'] ?? ''}}
                                </h3>

                                <p class="text-slate-300 text-base font-normal leading-relaxed mt-2.5">
                                    {{$point['content'] ?? ''}}
                                </p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center text-xs font-semibold text-purple-400 group-hover:text-purple-300 transition-colors">
                                <span>{{ __('Solicitar cotización para esta modalidad') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(!empty($service['webcontent']['faqs']['questions']))
        <x-questions
            title="{{ $service['webcontent']['faqs']['title'] ?? '' }}"
            :questions="$service['webcontent']['faqs']['questions']"
        />
    @endif
@endsection
