@section('robots', 'noindex, nofollow, noarchive')
@section('title', 'Recuperar Contraseña | LanEx')
@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full bg-slate-50 flex flex-col justify-center items-center px-6 py-12">
    <div class="w-full max-w-md">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                <img src="/images/logo.png" alt="LanEx" class="w-9 h-9 object-contain" />
                <span class="text-2xl font-extrabold tracking-tight font-display">
                    <span class="text-primary">Lan</span><span class="text-primary-dark">Ex</span>
                </span>
            </a>
            <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-600 hover:text-primary inline-flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                <span>{{ __('messages.dashboard.auth.back_to_login') }}</span>
            </a>
        </div>

        <div class="bg-white border border-slate-200/90 rounded-2xl shadow-sm p-8 sm:p-10">
            <div class="mb-6">
                <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-1">
                    Recuperación de Acceso
                </span>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display capitalize">
                    {{ __('messages.dashboard.auth.forgot_password') }}
                </h2>
                <p class="text-sm text-slate-600 mt-1">
                    Ingresa tu correo registrado y te enviaremos un enlace seguro para restablecer tu contraseña.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-start gap-3 animation-fade-in">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                    <div>
                        <p class="font-bold text-emerald-800">{{ __('¡Enlace enviado!') }}</p>
                        <p class="text-xs mt-1 text-emerald-700 leading-relaxed">{{ session('status') }}</p>
                        <p class="text-[11px] mt-2 text-emerald-800 font-medium bg-emerald-100/80 px-2.5 py-1.5 rounded-lg inline-block">
                            💡 Si no lo ves en tu bandeja de entrada en 1-2 minutos, revisa tu carpeta de <strong>Spam o Correo no deseado</strong>.
                        </p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm flex items-start gap-3 animation-fade-in">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                    <div>
                        <p class="font-bold text-rose-800">{{ __('No se pudo enviar el correo') }}</p>
                        <p class="text-xs mt-1 text-rose-700 leading-relaxed">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        {{ __("messages.dashboard.auth.email") }}
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', '') }}"
                        placeholder="nombre@lanex.pe"
                        required
                        class="w-full h-11 px-4 text-sm rounded-xl border @error('email') border-rose-400 bg-rose-50/30 @else border-slate-300 bg-slate-50/60 @enderror text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                    >
                    @error('email')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full h-11 bg-primary hover:bg-primary-dark text-white font-semibold text-sm rounded-xl shadow-sm transition-all duration-200 inline-flex items-center justify-center gap-2 capitalize"
                >
                    <span>{{ __('messages.dashboard.auth.send_password_reset_link') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    @if(session('status'))
        showToast(["{{ session('status') }}"]);
    @endif

    @if(session('errors'))
        showToast(@json($errors->all()));
    @endif
});
</script>
@endsection
