@section('robots', 'noindex, nofollow, noarchive')
@section('title', 'Iniciar Sesión | LanEx')
@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full bg-slate-50 grid grid-cols-1 lg:grid-cols-12">
    <!-- Left Column: Brand & Operational Telemetry Panel -->
    <div class="hidden lg:flex lg:col-span-5 bg-slate-950 text-white flex-col justify-between p-12 relative overflow-hidden border-r border-slate-800">
        <!-- Subtle Top Radial Accent -->
        <div class="pointer-events-none absolute -top-24 -left-24 w-96 h-96 rounded-full bg-purple-600/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 right-0 w-80 h-80 rounded-full bg-indigo-600/10 blur-3xl"></div>

        <!-- Top Brand Header -->
        <div class="relative z-10 flex items-center justify-between">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <img src="/images/logo.png" alt="LanEx" class="w-10 h-10 object-contain" />
                <span class="text-2xl font-extrabold tracking-tight font-display">
                    <span class="text-purple-400">Lan</span><span class="text-white">Ex</span>
                </span>
            </a>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-300 hover:text-white border border-slate-800 hover:border-slate-700 bg-slate-900/80 px-3.5 py-2 rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                <span>Volver a la web</span>
            </a>
        </div>

        <!-- Center Operational Proposition -->
        <div class="relative z-10 my-auto py-12">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-purple-500/15 border border-purple-400/30 text-purple-300 text-xs font-mono uppercase tracking-widest mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                CONSOLA ADMINISTRATIVA · SOUL
            </span>
            <h1 class="text-3xl xl:text-4xl font-extrabold text-white tracking-tight leading-tight font-display mb-4">
                Control centralizado de operaciones y comercio exterior.
            </h1>
            <p class="text-slate-300 text-sm leading-relaxed mb-8 max-w-md">
                Administra órdenes de carga internacional, estados de tránsito, facturación operativa, cartera de clientes y contenidos del portal desde un único entorno seguro.
            </p>

            <!-- Feature List -->
            <div class="space-y-3.5 border-t border-slate-800/90 pt-6">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/15 border border-purple-500/30 flex items-center justify-center text-purple-300 shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Trazabilidad y Estados de Carga</p>
                        <p class="text-xs text-slate-400">Actualización de etapas de envío y notificaciones automáticas por correo.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/15 border border-purple-500/30 flex items-center justify-center text-purple-300 shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Control Financiero y Liquidación DAM</p>
                        <p class="text-xs text-slate-400">Monitoreo de montos netos, costos operativos, manifiestos y canales SUNAT.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/15 border border-purple-500/30 flex items-center justify-center text-purple-300 shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Gestión de Proveedores y Catálogo Web</p>
                        <p class="text-xs text-slate-400">Publicación inmediata de servicios, proveedores verificados, productos y artículos.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="relative z-10 flex items-center justify-between text-xs text-slate-400 border-t border-slate-800/80 pt-6">
            <span>© {{ date('Y') }} LanEx · Express Lane Logistics</span>
            <span class="font-mono text-slate-300">Callao, Perú</span>
        </div>
    </div>

    <!-- Right Column: Login Card -->
    <div class="lg:col-span-7 flex flex-col justify-center items-center px-6 py-12 sm:px-12">
        <div class="w-full max-w-md">
            <!-- Mobile Header -->
            <div class="flex lg:hidden items-center justify-between mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                    <img src="/images/logo.png" alt="LanEx" class="w-9 h-9 object-contain" />
                    <span class="text-2xl font-extrabold tracking-tight font-display">
                        <span class="text-primary">Lan</span><span class="text-primary-dark">Ex</span>
                    </span>
                </a>
                <a href="{{ route('home') }}" class="text-xs font-semibold text-slate-600 hover:text-primary inline-flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Volver al inicio</span>
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white border border-slate-200/90 rounded-2xl shadow-sm p-8 sm:p-10">
                <div class="mb-7">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-1.5">
                        Acceso Administrativo
                    </span>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
                        {{ __('messages.dashboard.auth.login') }}
                    </h2>
                    <p class="text-sm text-slate-600 mt-1">
                        Ingresa tus credenciales operativas para acceder al panel de gestión.
                    </p>
                </div>

                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 text-xs text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <p class="font-medium">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if(session('status') || session('success'))
                    <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-xs text-emerald-700 font-medium">
                        {{ session('status') ?? session('success') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="mb-6 rounded-xl bg-blue-50 border border-blue-200 p-4 text-xs text-blue-700 font-medium">
                        {{ session('info') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            {{ __("messages.dashboard.auth.email") }}
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            </span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', '') }}"
                                placeholder="nombre@lanex.pe"
                                required
                                autocomplete="email"
                                class="w-full h-11 pl-10 pr-4 text-sm rounded-xl border border-slate-300 bg-slate-50/60 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                            >
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                {{ __("messages.dashboard.auth.password") }}
                            </label>
                            <a href="{{ route('showForgotPassword') }}" class="text-xs font-semibold text-primary hover:text-primary-dark transition-colors">
                                {{ __('messages.dashboard.auth.forgot_password') }}
                            </a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                                class="w-full h-11 pl-10 pr-11 text-sm rounded-xl border border-slate-300 bg-slate-50/60 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                            >
                            <button
                                type="button"
                                id="toggle-password"
                                aria-label="Mostrar u ocultar contraseña"
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 cursor-pointer text-slate-400 hover:text-primary transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full h-11 bg-primary hover:bg-primary-dark text-white font-semibold text-sm rounded-xl shadow-sm transition-all duration-200 inline-flex items-center justify-center gap-2 active:scale-[0.99]"
                    >
                        <span>{{ __('messages.dashboard.auth.login') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-slate-100 text-center text-xs text-slate-500">
                    <span>Acceso restringido únicamente a operadores autorizados por la administración.</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    @if(session('success'))
        showToast(["{{ session('success') }}"]);
    @endif

    @if($errors->any())
        showToast(@json($errors->all()));
    @endif

    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("toggle-password");
    const eyeIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>`;
    const eyeOffIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>`;

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePassword.innerHTML = eyeOffIcon;
            } else {
                passwordInput.type = "password";
                togglePassword.innerHTML = eyeIcon;
            }
        });
    }
});
</script>
@endsection
