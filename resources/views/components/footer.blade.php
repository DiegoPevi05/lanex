<!-- resources/views/components/footer.blade.php -->
<footer id="footer" class="w-full bg-slate-950 text-slate-400 border-t border-slate-800/80">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-14 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 pb-12 border-b border-slate-800/80">
            <!-- Col 1: Brand & Contact -->
            <div class="lg:col-span-4 flex flex-col gap-4">
                <a href="{{ route('home') }}" class="w-auto flex items-center gap-2 group" aria-label="{{ __('messages.aria_labels.home') }}" title="{{ __('messages.titles.home') }}">
                    <div class="w-[42px] h-auto transition group-hover:scale-103 duration-200">
                        <img src="/images/logo.png" alt="logo" class="h-auto w-full brightness-110" />
                    </div>
                    <div class="flex items-baseline tracking-tight">
                        <span class="font-extrabold text-2xl text-purple-400 font-display">Lan</span><span class="font-extrabold text-2xl text-white font-display">Ex</span>
                    </div>
                </a>

                <p class="text-xs sm:text-sm text-slate-400 font-normal leading-relaxed">
                    {{ __('Operador logístico internacional y freight forwarder con sede en Callao, Perú. Conectamos tus importaciones desde China, Estados Unidos y el mundo con agenciamiento aduanero y fletes multimodales.') }}
                </p>

                <div class="flex flex-col gap-2 pt-2 text-xs">
                    <a href="tel:+51992764991" class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors duration-200">
                        <x-heroicon-o-phone class="h-4 w-4 text-primary shrink-0" />
                        <span class="font-semibold">+51 992 764 991</span>
                    </a>
                    <a href="mailto:operaciones@lanexsac.com" class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors duration-200">
                        <x-heroicon-o-envelope class="h-4 w-4 text-primary shrink-0" />
                        <span class="font-semibold break-all">operaciones@lanexsac.com</span>
                    </a>
                </div>

                <div class="flex items-center gap-3 pt-2 text-slate-400">
                    <a href="https://www.linkedin.com/company/expresslane-logistics-s-a-c/" target="_blank" aria-label="LinkedIn" class="hover:text-white hover:scale-110 transition-all p-1.5 rounded-lg bg-slate-900 border border-slate-800">
                        <x-bi-linkedin class="w-4 h-4" />
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61566765038948" target="_blank" aria-label="Facebook" class="hover:text-white hover:scale-110 transition-all p-1.5 rounded-lg bg-slate-900 border border-slate-800">
                        <x-bi-facebook class="w-4 h-4" />
                    </a>
                    <a href="https://www.instagram.com/expresslanelogisticssac" target="_blank" aria-label="Instagram" class="hover:text-white hover:scale-110 transition-all p-1.5 rounded-lg bg-slate-900 border border-slate-800">
                        <x-bi-instagram class="w-4 h-4" />
                    </a>
                    <a href="https://www.tiktok.com/@expresslanelogisticssac" target="_blank" aria-label="TikTok" class="hover:text-white hover:scale-110 transition-all p-1.5 rounded-lg bg-slate-900 border border-slate-800">
                        <x-bi-tiktok class="w-4 h-4" />
                    </a>
                </div>

                <div class="pt-2">
                    <a href="{{ route('claims') }}" class="inline-flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-800 hover:border-purple-500/70 hover:bg-purple-950/20 text-slate-300 hover:text-white transition-all duration-200 group shadow-xs" title="{{ __('Libro de Reclamaciones Virtual') }}">
                        <div class="w-9 h-9 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 shrink-0 group-hover:scale-105 group-hover:bg-primary group-hover:text-white transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="text-xs font-bold text-white group-hover:text-purple-300 transition-colors">{{ __('Libro de Reclamaciones') }}</span>
                            <span class="text-[10px] text-slate-400 font-normal">{{ __('Conforme a Ley N° 29571') }}</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Col 2: Navigation -->
            <div class="lg:col-span-2 flex flex-col gap-3">
                <span class="text-xs font-bold uppercase tracking-wider text-white">{{ __('Navegación') }}</span>
                <ul class="flex flex-col gap-2.5 text-xs text-slate-400 font-normal">
                    <li><a href="{{ route('home') }}" class="hover:text-white hover:underline transition-colors">{{ __('messages.navbar.home') }}</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white hover:underline transition-colors">{{ __('messages.navbar.aboutus') }}</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white hover:underline transition-colors">{{ __('messages.navbar.services') }}</a></li>
                    <li><a href="{{ route('suppliers') }}" class="hover:text-white hover:underline transition-colors">{{ __('messages.navbar.suppliers') }}</a></li>
                    <li><a href="{{ route('blogs') }}" class="hover:text-white hover:underline transition-colors">{{ __('messages.navbar.blogs') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white hover:underline transition-colors">{{ __('messages.navbar.contact') }}</a></li>
                    <li><a href="{{ route('claims') }}" class="hover:text-purple-300 hover:underline transition-colors flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>{{ __('Libro de Reclamaciones') }}</a></li>
                </ul>
            </div>

            <!-- Col 3: Services -->
            <div class="lg:col-span-3 flex flex-col gap-3">
                <span class="text-xs font-bold uppercase tracking-wider text-white">{{ __('Servicios') }}</span>
                <ul class="flex flex-col gap-2.5 text-xs text-slate-400 font-normal">
                    <li><a href="{{ route('services') }}" class="hover:text-white hover:underline transition-colors">{{ __('Flete Marítimo (FCL / LCL)') }}</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white hover:underline transition-colors">{{ __('Carga Aérea Express') }}</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white hover:underline transition-colors">{{ __('Agenciamiento de Aduanas SUNAT') }}</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white hover:underline transition-colors">{{ __('Almacén & Consolidado China / Miami') }}</a></li>
                    <li><a href="{{ route('quote') }}" class="hover:text-white hover:underline transition-colors">{{ __('Solicitar Cotización de Flete') }}</a></li>
                    <li><a href="{{ route('track') }}" class="hover:text-white hover:underline transition-colors">{{ __('Rastreo de Guías en Vivo') }}</a></li>
                </ul>
            </div>

            <!-- Col 4: Newsletter -->
            <div class="lg:col-span-3 flex flex-col gap-3">
                <span class="text-xs font-bold uppercase tracking-wider text-white">{{ __('messages.footer.subscribe') }}</span>
                <p class="text-xs text-slate-400 font-normal leading-relaxed">
                    {{ __('Recibe actualizaciones semanales sobre tarifas de flete, rutas marítimas y normativas aduaneras en tu correo.') }}
                </p>

                @if(session('success'))
                    <div class="p-3 rounded-lg bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('info'))
                    <div class="p-3 rounded-lg bg-amber-500/20 border border-amber-500/40 text-amber-300 text-xs flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                @if($errors->has('email'))
                    <div class="p-3 rounded-lg bg-rose-500/20 border border-rose-500/40 text-rose-300 text-xs">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form action="{{ route('subscribe.submit') }}" method="POST" class="flex flex-col gap-2 mt-1">
                    @csrf
                    <label for="footer_newsletter_email" class="text-[11px] font-medium text-slate-400">{{ __('Correo electrónico corporativo') }}</label>
                    <input
                        id="footer_newsletter_email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        required
                        placeholder="{{ __('messages.footer.subscribe_placeholder') }}"
                        class="w-full h-11 bg-slate-900 border border-slate-700 focus:border-primary focus:ring-1 focus:ring-primary rounded-lg px-3.5 text-sm text-white placeholder:text-slate-500 focus:outline-none transition-colors"
                    />

                    <button
                        type="submit"
                        class="taste-btn h-11 px-4 w-full font-semibold text-xs uppercase tracking-wider rounded-lg bg-primary hover:bg-primary-dark text-white cursor-pointer"
                    >
                        {{ __('messages.footer.subscribe_btn') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Copyright Row -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                <span>Copyright © {{$currentYear}} Lan<span class="text-purple-400 font-bold">Ex</span> {{ __('Express Lane Logistics S.A.C. Todos los derechos reservados.') }}</span>
                <span class="hidden sm:inline w-px h-3.5 bg-slate-800"></span>
                <a href="{{ route('claims') }}" class="text-slate-400 hover:text-purple-300 transition-colors inline-flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                    {{ __('Libro de Reclamaciones') }}
                </a>
            </div>
            <span>{{ __('messages.footer.developed_by') }} <a href="https://medialitica.pe/" target="_blank" rel="noopener noreferrer" class="hover:text-white hover:underline transition-colors">Medialitica</a></span>
        </div>
    </div>
</footer>

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
