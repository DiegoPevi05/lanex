@section('robots', 'noindex, nofollow, noarchive')
@section('title', 'Registro | LanEx')
@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full bg-slate-50 grid grid-cols-1 lg:grid-cols-12">
    <!-- Left Column: Brand & Security Context -->
    <div class="hidden lg:flex lg:col-span-5 bg-slate-950 text-white flex-col justify-between p-12 relative overflow-hidden border-r border-slate-800">
        <div class="pointer-events-none absolute -top-24 -left-24 w-96 h-96 rounded-full bg-purple-600/15 blur-3xl"></div>

        <div class="relative z-10 flex items-center justify-between">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
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

        <div class="relative z-10 my-auto py-12">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-purple-500/15 border border-purple-400/30 text-purple-300 text-xs font-mono uppercase tracking-widest mb-5">
                REGISTRO DE OPERADOR AUTORIZADO
            </span>
            <h1 class="text-3xl xl:text-4xl font-extrabold text-white tracking-tight leading-tight font-display mb-4">
                Alta de credenciales en la plataforma LanEx.
            </h1>
            <p class="text-slate-300 text-sm leading-relaxed max-w-md">
                Para crear una cuenta administrativa necesitas la clave maestra de seguridad proporcionada por la gerencia de operaciones de LanEx.
            </p>
        </div>

        <div class="relative z-10 flex items-center justify-between text-xs text-slate-400 border-t border-slate-800/80 pt-6">
            <span>© {{ date('Y') }} LanEx · Express Lane Logistics</span>
            <span class="font-mono text-slate-300">Callao, Perú</span>
        </div>
    </div>

    <!-- Right Column: Registration Form -->
    <div class="lg:col-span-7 flex flex-col justify-center items-center px-6 py-10 sm:px-12">
        <div class="w-full max-w-md">
            <div class="flex lg:hidden items-center justify-between mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                    <img src="/images/logo.png" alt="LanEx" class="w-9 h-9 object-contain" />
                    <span class="text-2xl font-extrabold tracking-tight font-display">
                        <span class="text-primary">Lan</span><span class="text-primary-dark">Ex</span>
                    </span>
                </a>
                <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-600 hover:text-primary">
                    Iniciar sesión
                </a>
            </div>

            <div class="bg-white border border-slate-200/90 rounded-2xl shadow-sm p-8 sm:p-10">
                <div class="mb-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-1">
                        Credenciales Operativas
                    </span>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display capitalize">
                        {{ __('messages.dashboard.auth.register') }}
                    </h2>
                </div>

                @if($errors->any())
                    <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4 text-xs text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <p class="font-medium">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __("messages.dashboard.auth.name") }}
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', '') }}"
                            placeholder="{{ __("messages.dashboard.auth.name") }}"
                            required
                            class="w-full h-11 px-4 text-sm rounded-xl border border-slate-300 bg-slate-50/60 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __("messages.dashboard.auth.email") }}
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', '') }}"
                            placeholder="nombre@lanex.pe"
                            required
                            class="w-full h-11 px-4 text-sm rounded-xl border border-slate-300 bg-slate-50/60 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __("messages.dashboard.auth.password") }}
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                class="w-full h-11 pl-4 pr-11 text-sm rounded-xl border border-slate-300 bg-slate-50/60 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                            >
                            <button type="button" id="toggle-password" data-id="password" class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3.5 cursor-pointer text-slate-400 hover:text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __("messages.dashboard.auth.password_confirmation") }}
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="••••••••"
                                required
                                class="w-full h-11 pl-4 pr-11 text-sm rounded-xl border border-slate-300 bg-slate-50/60 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                            >
                            <button type="button" id="toggle-password-confirmation" data-id="password_confirmation" class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3.5 cursor-pointer text-slate-400 hover:text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="keyword" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __("messages.dashboard.auth.keyword") }}
                        </label>
                        <input
                            type="text"
                            id="keyword"
                            name="keyword"
                            value="{{ old('keyword', '') }}"
                            placeholder="{{ __("messages.dashboard.auth.keyword") }}"
                            required
                            class="w-full h-11 px-4 text-sm rounded-xl border border-slate-300 bg-slate-50/60 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full h-11 mt-2 bg-primary hover:bg-primary-dark text-white font-semibold text-sm rounded-xl shadow-sm transition-all duration-200 inline-flex items-center justify-center gap-2 capitalize"
                    >
                        <span>{{ __('messages.dashboard.auth.register') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                </form>

                <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-primary hover:text-primary-dark transition-colors">
                        {{ __('messages.dashboard.auth.have_an_account') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    @if($errors->any())
        showToast(@json($errors->all()));
    @endif

    const eyeIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>`;
    const eyeOffIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>`;

    const togglePasswords = document.querySelectorAll(".toggle-password");
    togglePasswords.forEach((toggle) => {
        const passwordInput = document.getElementById(toggle.dataset.id);
        if (!passwordInput) return;
        toggle.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggle.innerHTML = eyeOffIcon;
            } else {
                passwordInput.type = "password";
                toggle.innerHTML = eyeIcon;
            }
        });
    });
});
</script>
@endsection
