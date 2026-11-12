@section('title', 'LanEx — Operador Logístico Internacional y Agenciamiento de Carga')
@section('meta_description', __('messages.meta.home'))
@extends('layouts.client')

@section('content-client')
    <!-- Hero Section: Cinematic High-Clarity Logistics Backdrop with Side Tracking Command Box -->
    <section id="home_hero_section" data-enter class="w-full flex flex-col min-h-[95svh] pt-[160px] xl:pt-[190px] pb-24 relative z-10 text-white overflow-hidden bg-slate-950">
        <!-- Background Photography with Balanced Visibility & Contrast -->
        <img
            src="{{ asset('storage/images/web/cargo_port_hero.jpg') }}"
            alt="{{ __('Terminal de Carga Marítima LanEx') }}"
            class="hero-enter-media w-full h-full absolute inset-0 object-cover object-center z-10 opacity-60"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-primary-dark/45 z-20 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary/35 via-transparent to-transparent z-20 pointer-events-none"></div>

        <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-8 lg:py-14 z-30 flex-1 flex flex-col justify-center">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Column: Value Proposition -->
                <div class="lg:col-span-7 flex flex-col gap-y-4">
                    <span class="hero-enter-item text-xs sm:text-sm font-bold uppercase tracking-widest text-purple-400 block font-sans">
                        {{ __('SOMOS UN OPERADOR LOGISTICO INTERNACIONAL') }}
                    </span>

                    <h1 class="hero-enter-item text-3xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-[1.12]">
                        {{ __('Optimiza la logística de tu negocio con nuestros servicios en comercio exterior (carga y aduana)') }}
                    </h1>

                    <p class="hero-enter-item text-base sm:text-lg text-slate-300 max-w-xl font-normal leading-relaxed pt-2">
                        {{ __('Simplifica tus procesos logísticos con nuestros servicios en comercio exterior. Buscas explorar nuevos mercados, en LanEx te brindamos las mejores soluciones logísticas para hacer crecer tu negocio') }}
                    </p>

                    <!-- Metrics Ribbon -->
                    <div class="hero-enter-item grid grid-cols-3 gap-4 pt-6 max-w-lg border-t border-white/10 mt-3">
                        <div>
                            <span class="block font-bold text-2xl sm:text-3xl text-white tracking-tight">+26K</span>
                            <span class="block text-xs text-slate-400 font-normal mt-0.5">{{ __('Cargas Despachadas') }}</span>
                        </div>
                        <div>
                            <span class="block font-bold text-2xl sm:text-3xl text-purple-400 tracking-tight">{{ __('12+ Años') }}</span>
                            <span class="block text-xs text-slate-400 font-normal mt-0.5">{{ __('Comercio Exterior') }}</span>
                        </div>
                        <div>
                            <span class="block font-bold text-2xl sm:text-3xl text-emerald-400 tracking-tight">100%</span>
                            <span class="block text-xs text-slate-400 font-normal mt-0.5">{{ __('Trazabilidad Segura') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Command Center Tracking Card -->
                <div class="lg:col-span-5 w-full hero-enter-item">
                    <div class="bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden text-slate-800">
                        <!-- Card Header / Tabs -->
                        <div class="flex items-center border-b border-slate-100 bg-slate-50/80 p-1.5">
                            <button type="button" class="flex-1 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold bg-white text-primary shadow-sm flex items-center justify-center gap-2 transition duration-200">
                                <svg class="w-4 h-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                <span>{{ __('Rastrear Envío') }}</span>
                            </button>
                            <a href="{{ route('quote') }}" class="flex-1 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-semibold text-slate-600 hover:text-primary hover:bg-white/60 flex items-center justify-center gap-2 transition duration-200">
                                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
                                <span>{{ __('messages.common.quote') }}</span>
                            </a>
                        </div>

                        <!-- Card Body: Tracking Form -->
                        <div class="p-6 sm:p-7 flex flex-col gap-4">
                            <div>
                                <label for="tracking_id_input" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">
                                    {{ __('Número de Guía o Código de Orden') }}
                                </label>
                                <form id="hero_tracking_form" action="{{ route('track') }}" method="GET" class="flex flex-col gap-3">
                                    <div class="flex items-center border border-slate-300 focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 rounded-xl p-1 bg-white">
                                        <div class="pl-3 pr-2 text-slate-400">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                        </div>
                                        <input
                                            id="tracking_id_input"
                                            name="order"
                                            type="text"
                                            required
                                            minlength="3"
                                            placeholder="{{ __('Ej: LX-102948') }}"
                                            class="w-full bg-transparent py-2.5 text-base font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none uppercase tracking-wider"
                                        />
                                    </div>

                                    <button
                                        type="submit"
                                        id="tracking_id_btn"
                                        class="taste-btn w-full h-12 px-6 rounded-xl bg-primary hover:bg-primary-dark text-white font-bold text-sm tracking-wide uppercase shadow-md flex items-center justify-center gap-2 group cursor-pointer"
                                    >
                                        <span>{{ __('messages.common.search') }}</span>
                                        <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </button>
                                </form>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs text-slate-500">
                                <span>{{ __('messages.home.hero.input_helper_text') }}</span>
                                <a href="https://wa.link/s7w6z3" target="_blank" class="font-bold text-primary hover:text-primary-dark inline-flex items-center gap-1 hover:underline">
                                    <span>{{ __('messages.home.hero.input_helper_help') }}</span>
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shipping Estimator Component -->
    <x-calculator-shipping />

    <!-- Step Guide: Image + Text Section (Elevated, Real Logistics Operations + Scroll SVG Connector) -->
    <section id="home_step_guide" class="scroll-svg-section w-full py-16 sm:py-24 bg-white text-slate-800 border-b border-slate-200/80" data-scroll-title="{{ __('Proceso') }}">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col gap-12">
            <!-- Top Split: Editorial Value + Real Logistics Image -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-6 flex flex-col gap-3">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary block">
                        {{ __('messages.home.step.header') }}
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
                        {{ __('messages.home.step.title') }}
                    </h2>
                    <p class="text-slate-600 text-base font-normal leading-relaxed mt-2">
                        {{ __('messages.home.step.content') }}
                    </p>
                    <div class="pt-4 flex flex-wrap gap-5 text-sm text-slate-600 font-normal">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                            {{ __('Consolidación en origen') }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                            {{ __('Agenciamiento SUNAT') }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                            {{ __('Entrega puerta a puerta') }}
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 pt-4">
                        <a href="{{ route('quote') }}" class="taste-btn inline-flex items-center gap-2 h-11 px-6 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm group">
                            <span>{{ __('Solicitar Cotización') }}</span>
                            <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('services') }}" class="taste-btn inline-flex items-center gap-2 h-11 px-5 rounded-xl border border-slate-300 hover:border-slate-900 text-slate-700 hover:text-slate-900 font-semibold text-sm">
                            <span>{{ __('Explorar Servicios') }}</span>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-6">
                    <div class="taste-photo-wrap relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-900">
                        <img
                            src="{{ asset('storage/images/web/cosco.webp') }}"
                            alt="{{ __('Operaciones de comercio exterior y transporte marítimo LanEx') }}"
                            class="taste-photo-zoom w-full h-[290px] sm:h-[330px] object-cover object-center"
                        />
                    </div>
                </div>
            </div>

            <!-- Steps Architectural Grid (Hairline Columns, No AI Box Clutter) -->
            <div class="grid grid-cols-1 md:grid-cols-3 border-t border-slate-200 divide-y md:divide-y-0 md:divide-x divide-slate-200">
                <!-- Step 1 -->
                <div class="js-narrative-step py-8 md:pr-8 lg:pr-10 flex flex-col justify-between gap-4" data-step="0">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xl font-bold text-slate-400">01</span>
                        <span class="text-xs font-bold uppercase tracking-wider text-primary">
                            {{ __('messages.home.step.step_1_label') }}
                        </span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-bold text-slate-900 text-lg sm:text-xl tracking-tight">
                            {{ __('messages.home.step.step_1_title') }}
                        </h3>
                        <p class="text-base text-slate-600 font-normal leading-relaxed">
                            {{ __('messages.home.step.step_1_content') }}
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="js-narrative-step py-8 md:px-8 lg:px-10 flex flex-col justify-between gap-4" data-step="1">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xl font-bold text-slate-400">02</span>
                        <span class="text-xs font-bold uppercase tracking-wider text-primary">
                            {{ __('messages.home.step.step_2_label') }}
                        </span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-bold text-slate-900 text-lg sm:text-xl tracking-tight">
                            {{ __('messages.home.step.step_2_title') }}
                        </h3>
                        <p class="text-base text-slate-600 font-normal leading-relaxed">
                            {{ __('messages.home.step.step_2_content') }}
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="js-narrative-step py-8 md:pl-8 lg:pl-10 flex flex-col justify-between gap-4" data-step="2">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xl font-bold text-slate-400">03</span>
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">
                            {{ __('messages.home.step.step_3_label') }}
                        </span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-bold text-slate-900 text-lg sm:text-xl tracking-tight">
                            {{ __('messages.home.step.step_3_title') }}
                        </h3>
                        <p class="text-base text-slate-600 font-normal leading-relaxed">
                            {{ __('messages.home.step.step_3_content') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands & Verified Suppliers -->
    <x-brands-by-category title="{{ __('messages.home.brands') }}" :suppliers="$suppliers" />

    <!-- Services Section -->
    <x-services-section />

    <!-- Customer Reviews / Testimonials Wall -->
    @if(!empty($reviews) && count($reviews) > 0)
        <section id="reviews" class="w-full py-16 sm:py-24 bg-slate-50 text-slate-900 border-b border-slate-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col gap-10">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-2">
                            {{ __('messages.home.reviews.header') }}
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
                            {{ __('messages.home.reviews.title') }}
                        </h2>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-normal text-slate-500">
                        <div class="flex text-amber-400">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="font-bold text-slate-800">4.9 / 5.0</span>
                        <span>{{ __('en satisfacción de importadores') }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($reviews->take(3) as $review)
                        <div class="bg-white rounded-xl border border-slate-200/90 p-6 sm:p-7 flex flex-col justify-between gap-6">
                            <div class="flex flex-col gap-4">
                                <!-- Star Rating -->
                                <div class="flex items-center gap-1 text-amber-400">
                                    @for ($i = 0; $i < ($review->stars ?? 5); $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>

                                <p class="text-base text-slate-700 font-normal leading-relaxed italic">
                                    “{{ $review->review }}”
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-900 text-sm">{{ $review->name }}</span>
                                    <span class="text-xs text-slate-500 font-normal">{{ $review->charge }}</span>
                                </div>
                                <span class="text-xs font-medium text-emerald-700">
                                    {{ __('Cliente Verificado') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Questions / FAQ Section -->
    <x-questions title="{{ __('messages.home.questions.title') }}" :questions="$questions" />

    <!-- Blogs Carousel / Trade Insights -->
    <x-blogs-carousel :blogs="$blogs" />

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const trackingForm = document.getElementById('hero_tracking_form');
        const trackingInput = document.getElementById('tracking_id_input');
        const trackingBtn = document.getElementById('tracking_id_btn');

        if (trackingForm) {
            trackingForm.addEventListener('submit', function (e) {
                const val = trackingInput ? trackingInput.value.trim() : '';
                if (!val) {
                    e.preventDefault();
                    if (trackingInput) {
                        trackingInput.focus();
                        trackingInput.parentElement.classList.add('ring-2', 'ring-red-500', '!border-red-500');
                    }
                    return;
                }

                if (trackingBtn) {
                    trackingBtn.disabled = true;
                    trackingBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-3.5 w-3.5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Buscando...</span>
                    `;
                }
            });

            if (trackingInput) {
                trackingInput.addEventListener('input', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-red-500', '!border-red-500');
                });
            }
        }
    });
</script>
@endpush
