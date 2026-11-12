@section('title', 'Cotización de Carga Internacional y Servicios Logísticos | LanEx')
@section('meta_description', __('messages.meta.quote'))
@extends('layouts.client')

@section('content-client')
    <section id="quote_hero_section" data-enter class="w-full bg-slate-50 text-slate-900 pt-[160px] xl:pt-[190px] pb-20 sm:pb-24 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                <!-- Left Column: Quote Form -->
                <div class="lg:col-span-7 order-2 lg:order-1 hero-enter-item">
                    <form id="quote_form" action="{{route('quote.submit')}}" method="POST" class="w-full bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-10 shadow-xs flex flex-col gap-6 text-slate-900">
                        @csrf
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight font-display">
                                {{__('messages.quote.form.quote_form_title')}}
                            </h2>
                            <p class="text-sm text-slate-500 font-normal mt-1">
                                {{ __('Ingresa los detalles de origen, destino y tipo de mercancía para cotizar tu flete internacional.') }}
                            </p>
                        </div>

                        @if(!empty($interestItem))
                            <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-purple-50 to-indigo-50/50 border border-purple-200/90 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <div class="flex items-center gap-3.5 min-w-0">
                                    <div class="w-12 h-12 rounded-xl bg-white border border-purple-200 shadow-xs flex items-center justify-center p-2 shrink-0">
                                        @if($type === 'product' && !empty($interestItem->image))
                                            <img src="{{ asset('storage/' . $interestItem->image) }}" alt="{{ $interestItem->name }}" class="w-full h-full object-contain" onerror="this.src='/images/logo.png'">
                                        @elseif($type === 'supplier' && !empty($interestItem->logo))
                                            <img src="{{ asset('storage/' . $interestItem->logo) }}" alt="{{ $interestItem->name }}" class="w-full h-full object-contain" onerror="this.src='/images/logo.png'">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 mb-0.5">
                                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-primary text-white shrink-0">
                                                @if($type === 'product') Producto Seleccionado
                                                @elseif($type === 'service') Servicio Seleccionado
                                                @elseif($type === 'supplier') Proveedor Aliado
                                                @else Interés Seleccionado
                                                @endif
                                            </span>
                                            @if($type === 'product' && $interestItem->supplier)
                                                <span class="text-[11px] text-slate-500 font-medium truncate">Prov: {{ $interestItem->supplier->name }}</span>
                                            @endif
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-900 leading-tight truncate">{{ $interestItem->name }}</h3>
                                        <p class="text-[11px] text-slate-600 line-clamp-1 mt-0.5">
                                            @if($type === 'service')
                                                {{ $interestItem->webcontent['description'] ?? 'Servicio especializado de transporte y logística internacional.' }}
                                            @elseif($type === 'product')
                                                {{ $interestItem->description ?? 'Producto verificado para cotización de importación.' }}
                                            @elseif($type === 'supplier')
                                                {{ $interestItem->country ?? 'China' }} · {{ $interestItem->category ?? 'Proveedor verificado' }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <a href="{{ route('quote') }}" class="text-xs font-semibold text-slate-500 hover:text-red-600 transition-colors inline-flex items-center gap-1 shrink-0 px-2.5 py-1 rounded-lg bg-white border border-slate-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                    <span>Cambiar</span>
                                </a>
                            </div>

                            <input type="hidden" name="interest_type" value="{{ $type }}">
                            <input type="hidden" name="interest_id" value="{{ $interestItem->id }}">
                            <input type="hidden" name="interest_name" value="{{ $interestItem->name }}">
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="flex flex-col gap-1.5">
                                <label for="quote_form_full_name" class="text-sm font-semibold text-slate-800">
                                    {{__('messages.quote.form.quote_form_full_name_label')}}
                                </label>
                                <input
                                    id="quote_form_full_name"
                                    name="full_name"
                                    type="text"
                                    autocomplete="name"
                                    required
                                    class="w-full h-12 px-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors"
                                    placeholder="{{__('messages.quote.form.quote_form_full_name_placeholder')}}"
                                />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="quote_form_company" class="text-sm font-semibold text-slate-800">
                                    {{__('messages.quote.form.quote_form_company_label')}}
                                </label>
                                <input
                                    id="quote_form_company"
                                    name="company"
                                    type="text"
                                    autocomplete="organization"
                                    required
                                    class="w-full h-12 px-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors"
                                    placeholder="{{__('messages.quote.form.quote_form_company_placeholder')}}"
                                />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="quote_form_email" class="text-sm font-semibold text-slate-800">
                                    {{__('messages.quote.form.quote_form_email_label')}}
                                </label>
                                <input
                                    id="quote_form_email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    required
                                    class="w-full h-12 px-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors"
                                    placeholder="{{__('messages.quote.form.quote_form_email_placeholder')}}"
                                />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="quote_form_cellphone" class="text-sm font-semibold text-slate-800">
                                    {{__('messages.quote.form.quote_form_cellphone_label')}}
                                </label>
                                <input
                                    id="quote_form_cellphone"
                                    name="cellphone"
                                    type="tel"
                                    autocomplete="tel"
                                    required
                                    class="w-full h-12 px-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors"
                                    placeholder="{{__('messages.quote.form.quote_form_cellphone_placeholder')}}"
                                />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="quote_form_departure_address" class="text-sm font-semibold text-slate-800">
                                    {{__('messages.quote.form.quote_form_departure_address_label')}}
                                </label>
                                <input
                                    id="quote_form_departure_address"
                                    name="departure_address"
                                    type="text"
                                    required
                                    value="{{ old('departure_address', ($type === 'product' || $type === 'supplier') ? 'Guangzhou / Ningbo, China' : '') }}"
                                    class="w-full h-12 px-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors"
                                    placeholder="{{__('messages.quote.form.quote_form_departure_address_placeholder')}}"
                                />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="quote_form_arrival_address" class="text-sm font-semibold text-slate-800">
                                    {{__('messages.quote.form.quote_form_arrival_address_label')}}
                                </label>
                                <input
                                    id="quote_form_arrival_address"
                                    name="arrival_address"
                                    type="text"
                                    required
                                    value="{{ old('arrival_address', ($type === 'product' || $type === 'supplier') ? 'Callao, Perú' : '') }}"
                                    class="w-full h-12 px-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors"
                                    placeholder="{{__('messages.quote.form.quote_form_arrival_address_placeholder')}}"
                                />
                            </div>

                            <div class="sm:col-span-2 flex flex-col gap-1.5">
                                <label for="quote_form_message" class="text-sm font-semibold text-slate-800">
                                    {{__('messages.quote.form.quote_form_message_label')}}
                                </label>
                                <textarea
                                    id="quote_form_message"
                                    name="message"
                                    rows="4"
                                    required
                                    class="w-full p-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors leading-relaxed"
                                    placeholder="{{__('messages.quote.form.quote_form_message_placeholder')}}"
                                >@if(!empty($interestItem))@if($type === 'product')Deseo cotizar flete e importación para el producto: {{ $interestItem->name }}@if($interestItem->supplier) (Proveedor: {{ $interestItem->supplier->name }})@endif. Volumen / cantidad estimada: @elseif($type === 'service')Deseo solicitar cotización para el servicio logístico: {{ $interestItem->name }}. Requiero tarifas vigentes y tiempos estimados de tránsito.@elseif($type === 'supplier')Deseo cotizar flete e importación coordinando la recogida con el proveedor: {{ $interestItem->name }}. Tipo de mercancía: @endif @else{{ old('message') }}@endif</textarea>
                            </div>
                        </div>

                        <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <span class="text-xs text-slate-500">{{ __('Cotización integral con desglose de flete y gastos aduaneros.') }}</span>
                            <button type="submit" class="taste-btn w-full sm:w-auto h-12 px-8 bg-primary hover:bg-primary-dark text-white font-semibold text-sm rounded-xl inline-flex items-center justify-center gap-2 cursor-pointer group">
                                <span>{{__('messages.quote.form.quote_form_button')}}</span>
                                <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Context & Visual -->
                <div class="lg:col-span-5 order-1 lg:order-2 flex flex-col gap-6">
                    <div class="flex flex-col gap-3">
                        <span class="hero-enter-item text-xs font-bold uppercase tracking-widest text-primary block">
                            {{__('messages.quote.hero.header')}}
                        </span>
                        <h1 class="hero-enter-item text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 tracking-tight leading-tight font-display">
                            {{__('messages.quote.hero.title')}}
                        </h1>
                        <p class="hero-enter-item text-base text-slate-600 font-normal leading-relaxed mt-1">
                            {{ __('Evaluamos la ruta óptima para tu carga consolidada (LCL), contenedor completo (FCL) o envío aéreo express desde cualquier puerto de origen.') }}
                        </p>
                    </div>

                    <div class="hero-enter-item flex flex-col divide-y divide-slate-200 border-t border-b border-slate-200 py-2 text-sm text-slate-700">
                        <div class="py-3.5 flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>{{ __('Tarifas negociadas con navieras y aerolíneas de primer nivel') }}</span>
                        </div>
                        <div class="py-3.5 flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>{{ __('Clasificación arancelaria y liquidación de impuestos SUNAT') }}</span>
                        </div>
                        <div class="py-3.5 flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>{{ __('Seguro de carga internacional y transporte interno en Perú') }}</span>
                        </div>
                    </div>

                    <div class="hero-enter-item taste-photo-wrap bg-white rounded-2xl border border-slate-200/90 p-6 flex justify-center items-center">
                        <img src="{{ asset('storage/images/web/quote.svg') }}" alt="{{ __('Cotización de Carga LanEx') }}" class="taste-photo-zoom h-48 sm:h-60 w-auto object-contain" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-questions title="{{__('messages.quote.questions.title')}}" :questions="$questions" />
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
            showToast(["{{session('success')}}"]);
        @endif

        @if($errors->any())
            showToast(@json($errors->all()));
        @endif

        @if(session('error'))
            showToast(["{{session('error')}}"]);
        @endif

        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            return {
                origin: params.get("origin") || "",
                destiny: params.get("destiny") || "",
                content: params.get("content") || ""
            };
        }

        const { origin, destiny, content } = getQueryParams();

        const form = document.getElementById("quote_form");
        if (form) {
            if (origin) form.querySelector("#quote_form_departure_address").value = origin;
            if (destiny) form.querySelector("#quote_form_arrival_address").value = destiny;
            if (content) form.querySelector("#quote_form_message").value = content;
        }
    });
</script>
@endpush
