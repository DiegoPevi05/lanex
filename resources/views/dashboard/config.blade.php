@extends('layouts.dashboard')

@section('content-dashboard')
<section id="dashboard_config" class="bg-slate-50 h-full w-full flex flex-col p-4 sm:p-6 lg:p-8 gap-6 overflow-y-auto">
    <div class="max-w-5xl w-full mx-auto space-y-6">

        <!-- Header Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-purple-50 text-primary border border-purple-200/70 text-[11px] font-mono uppercase tracking-wider mb-2">
                        Centro de Control &amp; Comunicaciones
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-display tracking-tight">
                        Configuración del Sistema
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Define las direcciones de correo que recibirán las notificaciones de cotizaciones, libro de reclamaciones y contacto web.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        SMTP Hostinger Activo
                    </span>
                </div>
            </div>
        </div>

        <!-- Success & Error Alerts -->
        @if (session('status'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                <div class="flex-1">
                    <p class="font-bold text-emerald-800">{{ session('status') }}</p>
                </div>
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                <div class="flex-1">
                    <p class="font-bold text-rose-800">Por favor corrige los siguientes puntos:</p>
                    <ul class="text-xs mt-1 text-rose-700 list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Main Form -->
        <form action="{{ route('dashboard_settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section 1: Notification Recipient Emails -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                <div class="pb-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 font-display">
                            Destinatarios de Notificaciones
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Puedes ingresar un solo correo o varios separados por comas (ejemplo: <code class="bg-slate-100 px-1 py-0.5 rounded text-slate-700">ventas@lanexsac.com, admin@lanexsac.com</code>).
                        </p>
                    </div>
                </div>

                <!-- 1. Cotizaciones -->
                <div class="p-5 rounded-2xl border @error('quote_notification_email') border-rose-300 bg-rose-50/20 @else border-slate-200/80 bg-slate-50/40 @enderror transition-all">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 text-primary flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                            </div>
                            <div>
                                <label for="quote_notification_email" class="block text-sm font-bold text-slate-900">
                                    Solicitudes de Cotización (/quote)
                                </label>
                                <p class="text-xs text-slate-500">
                                    Recibirá las cotizaciones con datos de contacto, origen, destino y detalle de carga.
                                </p>
                            </div>
                        </div>

                        <!-- Test Button -->
                        <button
                            type="submit"
                            formaction="{{ route('dashboard_settings.test_email') }}"
                            name="type"
                            value="quote"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 text-xs font-semibold shadow-xs transition-colors shrink-0"
                            title="Enviar un correo de prueba a esta dirección"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                            <span>Probar Envío</span>
                        </button>
                    </div>

                    <input
                        type="text"
                        id="quote_notification_email"
                        name="quote_notification_email"
                        value="{{ old('quote_notification_email', $settings['quote_notification_email']) }}"
                        required
                        placeholder="cotizaciones@lanexsac.com, operaciones@lanexsac.com"
                        class="w-full h-11 px-4 text-sm rounded-xl border border-slate-300 bg-white text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                    >
                    @error('quote_notification_email')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 2. Libro de Reclamaciones -->
                <div class="p-5 rounded-2xl border @error('claims_notification_email') border-rose-300 bg-rose-50/20 @else border-slate-200/80 bg-slate-50/40 @enderror transition-all">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                            <div>
                                <label for="claims_notification_email" class="block text-sm font-bold text-slate-900">
                                    Libro de Reclamaciones Virtual (/libro-de-reclamaciones)
                                </label>
                                <p class="text-xs text-slate-500">
                                    Recibirá copia de los reclamos y quejas formales conforme a la Ley N° 29571.
                                </p>
                            </div>
                        </div>

                        <!-- Test Button -->
                        <button
                            type="submit"
                            formaction="{{ route('dashboard_settings.test_email') }}"
                            name="type"
                            value="claims"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 text-xs font-semibold shadow-xs transition-colors shrink-0"
                            title="Enviar un correo de prueba a esta dirección"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                            <span>Probar Envío</span>
                        </button>
                    </div>

                    <input
                        type="text"
                        id="claims_notification_email"
                        name="claims_notification_email"
                        value="{{ old('claims_notification_email', $settings['claims_notification_email']) }}"
                        required
                        placeholder="reclamos@lanexsac.com, legal@lanexsac.com"
                        class="w-full h-11 px-4 text-sm rounded-xl border border-slate-300 bg-white text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                    >
                    @error('claims_notification_email')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 3. Formulario de Contacto -->
                <div class="p-5 rounded-2xl border @error('contact_notification_email') border-rose-300 bg-rose-50/20 @else border-slate-200/80 bg-slate-50/40 @enderror transition-all">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            </div>
                            <div>
                                <label for="contact_notification_email" class="block text-sm font-bold text-slate-900">
                                    Formulario de Contáctanos (/contact)
                                </label>
                                <p class="text-xs text-slate-500">
                                    Recibirá las consultas comerciales, mensajes de empresas y RUC ingresados en la web.
                                </p>
                            </div>
                        </div>

                        <!-- Test Button -->
                        <button
                            type="submit"
                            formaction="{{ route('dashboard_settings.test_email') }}"
                            name="type"
                            value="contact"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 text-xs font-semibold shadow-xs transition-colors shrink-0"
                            title="Enviar un correo de prueba a esta dirección"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                            <span>Probar Envío</span>
                        </button>
                    </div>

                    <input
                        type="text"
                        id="contact_notification_email"
                        name="contact_notification_email"
                        value="{{ old('contact_notification_email', $settings['contact_notification_email']) }}"
                        required
                        placeholder="contacto@lanexsac.com, info@lanexsac.com"
                        class="w-full h-11 px-4 text-sm rounded-xl border border-slate-300 bg-white text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                    >
                    @error('contact_notification_email')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section 2: General Business Info -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                <div class="pb-4 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-900 font-display">
                        Información Comercial de Contacto
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Datos de contacto visibles en el pie de página y en las respuestas automáticas a los clientes.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="company_phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Teléfono Central
                        </label>
                        <input
                            type="text"
                            id="company_phone"
                            name="company_phone"
                            value="{{ old('company_phone', $settings['company_phone']) }}"
                            placeholder="+51 987 654 321"
                            class="w-full h-11 px-4 text-sm rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                        >
                    </div>

                    <div>
                        <label for="company_whatsapp" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            WhatsApp Comercial
                        </label>
                        <input
                            type="text"
                            id="company_whatsapp"
                            name="company_whatsapp"
                            value="{{ old('company_whatsapp', $settings['company_whatsapp']) }}"
                            placeholder="+51 987 654 321"
                            class="w-full h-11 px-4 text-sm rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                        >
                    </div>

                    <div class="sm:col-span-2">
                        <label for="company_address" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Dirección Legal / Oficina
                        </label>
                        <input
                            type="text"
                            id="company_address"
                            name="company_address"
                            value="{{ old('company_address', $settings['company_address']) }}"
                            placeholder="Callao, Lima - Perú"
                            class="w-full h-11 px-4 text-sm rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                        >
                    </div>
                </div>
            </div>

            <!-- Section 3: Technical Mail Infrastructure Status -->
            <div class="bg-slate-900 text-white rounded-2xl p-6 sm:p-7 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/20 border border-purple-500/40 flex items-center justify-center text-purple-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white font-display">
                            Infraestructura de Envío Activa
                        </h3>
                        <p class="text-[11px] text-slate-400">
                            Protocolo SMTP Hostinger con autorización SPF multi-proveedor.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                    <div class="p-3 rounded-xl bg-slate-800/80 border border-slate-700/80">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400 block mb-0.5">Servidor Saliente</span>
                        <span class="font-mono font-bold text-purple-300">smtp.hostinger.com:465</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-800/80 border border-slate-700/80">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400 block mb-0.5">Remitente Sistema</span>
                        <span class="font-mono font-bold text-slate-200">no-reply@lanexsac.com</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-800/80 border border-slate-700/80">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400 block mb-0.5">Estado SPF</span>
                        <span class="font-mono font-bold text-emerald-400">✅ Google + Hostinger</span>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex items-center justify-end gap-3 pt-2">
                <button
                    type="submit"
                    class="h-11 px-6 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm shadow-sm transition-all duration-200 inline-flex items-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span>Guardar Configuración</span>
                </button>
            </div>
        </form>

    </div>
</section>
@endsection
