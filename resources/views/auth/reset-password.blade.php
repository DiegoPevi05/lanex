@section('robots', 'noindex, nofollow, noarchive')
@section('title', 'Restablecer Contraseña | LanEx')
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
                    Seguridad de Cuenta
                </span>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display capitalize">
                    {{ __('messages.dashboard.auth.reset_password') }}
                </h2>
                <p class="text-sm text-slate-600 mt-1">
                    Crea una nueva contraseña segura para volver a ingresar a tu cuenta de LanEx.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                    <div>
                        <p class="font-bold text-emerald-800">{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                    <div>
                        <p class="font-bold text-rose-800">{{ __('No se pudo restablecer la contraseña') }}</p>
                        <p class="text-xs mt-1 text-rose-700 leading-relaxed">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        {{ __("messages.dashboard.auth.email") }}
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', request()->get('email', '')) }}"
                        placeholder="nombre@lanex.pe"
                        required
                        class="w-full h-11 px-4 text-sm rounded-xl border @error('email') border-rose-400 bg-rose-50/30 @else border-slate-300 bg-slate-50/60 @enderror text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none transition-all"
                    >
                    @error('email')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
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

                <button
                    type="submit"
                    class="w-full h-11 mt-2 bg-primary hover:bg-primary-dark text-white font-semibold text-sm rounded-xl shadow-sm transition-all duration-200 inline-flex items-center justify-center gap-2 capitalize"
                >
                    <span>{{ __('messages.dashboard.auth.reset_password') }}</span>
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

    @if ($errors->any())
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
