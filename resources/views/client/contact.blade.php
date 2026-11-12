@section('title', 'Contacto y Asesoría Logística | LanEx')
@section('meta_description', __('messages.meta.contactus'))
@extends('layouts.client')

@section('content-client')
    <section id="contact_hero_section" data-enter class="w-full bg-slate-50 text-slate-900 pt-[160px] xl:pt-[190px] pb-20 sm:pb-24 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                <!-- Left Column: Direct Contact & Context -->
                <div class="lg:col-span-5 flex flex-col gap-6">
                    <div class="flex flex-col gap-3">
                        <span class="hero-enter-item text-xs font-bold uppercase tracking-widest text-primary block">
                            {{ __('messages.contact.hero.header') }}
                        </span>
                        <h1 class="hero-enter-item text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 tracking-tight leading-tight font-display">
                            {{ __('messages.contact.hero.title') }}
                        </h1>
                        <p class="hero-enter-item text-base text-slate-600 font-normal leading-relaxed mt-1">
                            {{ __('Nuestro equipo de comercio exterior en Callao responde consultas sobre fletes marítimos, carga aérea y agenciamiento aduanero SUNAT.') }}
                        </p>
                    </div>

                    <!-- Direct Contact Channels -->
                    <div class="hero-enter-item flex flex-col divide-y divide-slate-200 border-t border-b border-slate-200 py-2">
                        <div class="py-4 flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-lg bg-purple-100 text-primary flex items-center justify-center shrink-0 mt-0.5">
                                <x-heroicon-o-phone class="w-4 h-4" />
                            </div>
                            <div>
                                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 block">{{ __('Teléfono y WhatsApp Comercial') }}</span>
                                <a href="tel:+51992764991" class="text-base font-bold text-slate-900 hover:text-primary transition-colors">+51 992 764 991</a>
                            </div>
                        </div>

                        <div class="py-4 flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-lg bg-purple-100 text-primary flex items-center justify-center shrink-0 mt-0.5">
                                <x-heroicon-o-envelope class="w-4 h-4" />
                            </div>
                            <div>
                                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 block">{{ __('Correo de Operaciones') }}</span>
                                <a href="mailto:operaciones@lanexsac.com" class="text-base font-bold text-slate-900 hover:text-primary transition-colors break-all">operaciones@lanexsac.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="hero-enter-item taste-photo-wrap bg-white rounded-2xl border border-slate-200/90 p-6 flex justify-center items-center">
                        <img src="{{ asset('storage/images/web/contact.svg') }}" alt="{{ __('Atención Comercial LanEx') }}" class="taste-photo-zoom h-44 sm:h-56 w-auto object-contain" />
                    </div>
                </div>

                <!-- Right Column: Contact Form -->
                <div class="lg:col-span-7 hero-enter-item">
                    <form action="{{ route('contact.submit') }}" method="POST" class="w-full bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-10 shadow-xs flex flex-col gap-6 text-slate-900">
                        @csrf
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight font-display">
                                {{ __('messages.contact.hero.form.contact_form_title') }}
                            </h2>
                            <p class="text-sm text-slate-500 font-normal mt-1">
                                {{ __('Completa los datos de tu empresa para asignarte un especialista logístico.') }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="sm:col-span-2 flex flex-col gap-1.5">
                                <label for="contact_form_email" class="text-sm font-semibold text-slate-800">
                                    {{ __('messages.contact.hero.form.contact_form_email_label') }}
                                </label>
                                <input
                                    id="contact_form_email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    required
                                    class="w-full h-12 px-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors"
                                    placeholder="{{ __('messages.contact.hero.form.contact_form_email_placeholder') }}"
                                />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="contact_form_company" class="text-sm font-semibold text-slate-800">
                                    {{ __('messages.contact.hero.form.contact_form_company_label') }}
                                </label>
                                <input
                                    id="contact_form_company"
                                    name="company"
                                    type="text"
                                    autocomplete="organization"
                                    required
                                    class="w-full h-12 px-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors"
                                    placeholder="{{ __('messages.contact.hero.form.contact_form_company_placeholder') }}"
                                />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="contact_form_ruc" class="text-sm font-semibold text-slate-800">
                                    {{ __('messages.contact.hero.form.contact_form_ruc_label') }}
                                </label>
                                <input
                                    id="contact_form_ruc"
                                    name="ruc"
                                    type="text"
                                    inputmode="numeric"
                                    required
                                    class="w-full h-12 px-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors"
                                    placeholder="{{ __('messages.contact.hero.form.contact_form_ruc_placeholder') }}"
                                />
                            </div>

                            <div class="sm:col-span-2 flex flex-col gap-1.5">
                                <label for="contact_form_message" class="text-sm font-semibold text-slate-800">
                                    {{ __('messages.contact.hero.form.contact_form_message_label') }}
                                </label>
                                <textarea
                                    id="contact_form_message"
                                    name="message"
                                    rows="4"
                                    required
                                    class="w-full p-4 border border-slate-300 rounded-xl text-base text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-colors leading-relaxed"
                                    placeholder="{{ __('messages.contact.hero.form.contact_form_message_placeholder') }}"
                                ></textarea>
                            </div>
                        </div>

                        <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <span class="text-xs text-slate-500">{{ __('Respuesta comercial en menos de 24 horas hábiles.') }}</span>
                            <button type="submit" class="taste-btn w-full sm:w-auto h-12 px-8 bg-primary hover:bg-primary-dark text-white font-semibold text-sm rounded-xl inline-flex items-center justify-center gap-2 cursor-pointer group">
                                <span>{{ __('messages.contact.hero.form.contact_form_button') }}</span>
                                <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <x-questions title="{{ __('messages.contact.questions.title') }}" :questions="$questions" />
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
    });
</script>
@endpush
