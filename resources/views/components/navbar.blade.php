<!-- resources/views/components/navbar.blade.php -->
<header id="navbar" class="fixed top-0 left-0 right-0 w-full flex flex-col h-auto z-[1200]">
    <a href="#top" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-4 focus:z-[120] focus:px-4 focus:py-2 focus:bg-primary focus:text-white focus:rounded-lg focus:font-semibold focus:text-xs">
        {{ __('Saltar al contenido principal') }}
    </a>
    <div class="hidden xl:flex w-full bg-slate-950 border-b border-slate-800/80 h-[44px] text-xs text-slate-300">
        <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 flex justify-between items-center">
            <div class="w-auto h-auto flex items-center divide-x divide-slate-800">
                <a href="mailto:operaciones@lanexsac.com" class="pr-4 font-normal hover:text-white transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    <span>operaciones@lanexsac.com</span>
                </a>
                <a href="tel:+51992764991" class="pl-4 font-normal hover:text-white transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>+51 992 764 991</span>
                </a>
            </div>
            <div class="w-auto h-auto flex justify-center gap-x-3 items-center">
                <a href="{{ route('track') }}" class="px-3 py-1 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-slate-800/80 transition-colors">
                    {{ __('messages.common.track') }}
                </a>
                <x-language-selector id="xl" />
                <a href="{{ Auth::user() ? route('dashboard_home') : route('login') }}"
                    class="h-7 w-7 text-slate-300 hover:text-white transition flex items-center justify-center rounded-lg hover:bg-slate-800/80"
                    aria-label="{{ Auth::user() ? __('messages.aria_labels.dashboard') : __('messages.aria_labels.login') }}"
                    title="{{ Auth::user() ? __('messages.titles.dashboard') : __('messages.titles.login') }}"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
                </a>
            </div>
        </div>
    </div>
    <div class="w-full bg-white border-b border-slate-200/90 h-[72px] transition-all">
        <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 h-full flex justify-between items-center">
            <a href="{{ route('home') }}" class="w-auto h-auto flex flex-row items-center gap-2 group" aria-label="{{ __('messages.aria_labels.home') }}" title="{{ __('messages.titles.home') }}">
                <div class="w-[42px] h-auto p-none transition group-hover:scale-103 duration-200">
                    <img src="/images/logo.png" alt="LanEx" class="h-auto w-full" />
                </div>
                <div class="w-auto flex flex-row items-baseline tracking-tight">
                    <span class="font-extrabold text-2xl text-primary font-display">Lan</span><span class="font-extrabold text-2xl text-primary-dark font-display">Ex</span>
                </div>
            </a>
            <div class="hidden xl:flex w-auto h-auto flex-row items-center gap-x-8 text-slate-700">
                <div class="w-auto h-auto flex flex-row items-center gap-x-7 text-[15px]">
                    <a href="{{ route('home') }}"
                        aria-label="{{ __('messages.aria_labels.home') }}"
                        title="{{ __('messages.titles.home') }}"
                        {!! request()->routeIs('home') ? 'aria-current="page"' : '' !!}
                        class="py-2 font-medium transition duration-150 hover:text-primary {{ request()->routeIs('home') ? 'text-primary border-b-2 border-primary font-semibold' : 'text-slate-700' }}">{{ __('messages.navbar.home') }}</a>
                    <a href="{{ route('about') }}"
                        aria-label="{{ __('messages.aria_labels.aboutus') }}"
                        title="{{ __('messages.titles.aboutus') }}"
                        {!! request()->routeIs('about') ? 'aria-current="page"' : '' !!}
                        class="py-2 font-medium transition duration-150 hover:text-primary {{ request()->routeIs('about') ? 'text-primary border-b-2 border-primary font-semibold' : 'text-slate-700' }}">{{ __('messages.navbar.aboutus') }}</a>
                    <a href="{{ route('services') }}"
                        aria-label="{{ __('messages.aria_labels.services') }}"
                        title="{{ __('messages.titles.services') }}"
                        {!! (request()->routeIs('services') || request()->routeIs('service')) ? 'aria-current="page"' : '' !!}
                        class="py-2 font-medium transition duration-150 hover:text-primary {{ request()->routeIs('services') || request()->routeIs('service') ? 'text-primary border-b-2 border-primary font-semibold' : 'text-slate-700' }}">{{ __('messages.navbar.services') }}</a>
                    <a href="{{ route('suppliers') }}"
                        aria-label="{{ __('messages.aria_labels.suppliers') }}"
                        title="{{ __('messages.titles.suppliers') }}"
                        {!! (request()->routeIs('suppliers') || request()->routeIs('supplier')) ? 'aria-current="page"' : '' !!}
                        class="py-2 font-medium transition duration-150 hover:text-primary {{ request()->routeIs('suppliers') || request()->routeIs('supplier') ? 'text-primary border-b-2 border-primary font-semibold' : 'text-slate-700' }}">{{ __('messages.navbar.suppliers') }}</a>
                    <a href="{{ route('blogs') }}"
                        aria-label="{{ __('messages.aria_labels.blogs') }}"
                        title="{{ __('messages.titles.blogs') }}"
                        {!! (request()->routeIs('blogs') || request()->routeIs('blog')) ? 'aria-current="page"' : '' !!}
                        class="py-2 font-medium transition duration-150 hover:text-primary {{ request()->routeIs('blogs') || request()->routeIs('blog') ? 'text-primary border-b-2 border-primary font-semibold' : 'text-slate-700' }}">{{ __('messages.navbar.blogs') }}</a>
                    <a href="{{ route('contact') }}"
                        aria-label="{{ __('messages.aria_labels.contactus') }}"
                        title="{{ __('messages.titles.contactus') }}"
                        {!! request()->routeIs('contact') ? 'aria-current="page"' : '' !!}
                        class="py-2 font-medium transition duration-150 hover:text-primary {{ request()->routeIs('contact') ? 'text-primary border-b-2 border-primary font-semibold' : 'text-slate-700' }}">{{ __('messages.navbar.contact') }}</a>
                </div>
                <a href="{{ route('quote') }}" class="taste-btn h-11 px-5 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-semibold inline-flex items-center gap-2">
                    <span>{{ __('messages.common.quote') }}</span>
                    <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>

            <div class="flex xl:hidden items-center gap-2.5">
                <a href="{{ route('quote') }}" class="hidden sm:inline-flex taste-btn h-11 px-4 rounded-xl bg-primary hover:bg-primary-dark text-white text-xs font-semibold items-center gap-1.5">
                    <span>{{ __('messages.common.quote') }}</span>
                </a>
                <button type="button" aria-label="{{ __('Abrir menú de navegación') }}" aria-expanded="false" class="navbar_menu_toggle_button h-11 w-11 flex justify-center items-center bg-slate-100 hover:bg-slate-200 text-slate-900 rounded-xl border border-slate-200 cursor-pointer">
                    <x-heroicon-o-bars-3 class="h-6 w-6" />
                </button>
            </div>
        </div>
    </div>
    <aside id="navbar_menu_scroll" class="fixed top-0 left-0 bottom-0 right-0 w-screen h-screen bg-white translate-x-[100%] transition-all duration-300 xl:hidden flex flex-col justify-start item-start px-8 py-10 sm:p-16 z-[100]">
        <div class="w-full flex justify-between items-center bg-transparent">
            <x-language-selector id="sm" />
            <button type="button" aria-label="{{ __('Cerrar menú de navegación') }}" class="navbar_menu_toggle_button h-11 w-11 flex items-center justify-center bg-slate-100 hover:bg-slate-200 rounded-xl border border-slate-200 cursor-pointer">
                <x-heroicon-o-x-mark class="h-6 w-6 text-slate-800" />
            </button>
        </div>
        <div class="w-full h-auto flex flex-between items-center mt-6">
            <div class="w-full h-auto flex flex-row items-center gap-2">
                <div class="w-[48px] h-auto p-none">
                    <img src="/images/logo.png" alt="logo" class="h-auto w-full" />
                </div>
                <div class="w-auto flex flex-row items-baseline tracking-tight">
                    <span class="font-extrabold text-2xl text-primary font-display">Lan</span><span class="font-extrabold text-2xl text-primary-dark font-display">Ex</span>
                </div>
            </div>
        </div>
        <div class="w-full h-auto flex flex-col gap-y-4 text-slate-800 mt-8">
            <a href="{{ route('home') }}"
                aria-label="{{ __('messages.aria_labels.home') }}"
                title="{{ __('messages.titles.home') }}"
                class="font-semibold text-lg hover:text-primary duration-200 py-1">{{ __('messages.navbar.home') }}</a>
            <a href="{{ route('about') }}"
                aria-label="{{ __('messages.aria_labels.aboutus') }}"
                title="{{ __('messages.titles.aboutus') }}"
                class="font-semibold text-lg hover:text-primary duration-200 py-1">{{ __('messages.navbar.aboutus') }}</a>
            <a href="{{ route('services') }}"
                aria-label="{{ __('messages.aria_labels.services') }}"
                title="{{ __('messages.titles.services') }}"
                class="font-semibold text-lg hover:text-primary duration-200 py-1">{{ __('messages.navbar.services') }}</a>
            <a href="{{ route('suppliers') }}"
                aria-label="{{ __('messages.aria_labels.suppliers') }}"
                title="{{ __('messages.titles.suppliers') }}"
                class="font-semibold text-lg hover:text-primary duration-200 py-1">{{ __('messages.navbar.suppliers') }}</a>
            <a href="{{ route('blogs') }}"
                aria-label="{{ __('messages.aria_labels.blogs') }}"
                title="{{ __('messages.titles.blogs') }}"
                class="font-semibold text-lg hover:text-primary duration-200 py-1">{{ __('messages.navbar.blogs') }}</a>
            <a href="{{ route('contact') }}"
                aria-label="{{ __('messages.aria_labels.contactus') }}"
                title="{{ __('messages.titles.contactus') }}"
                class="font-semibold text-lg hover:text-primary duration-200 py-1">{{ __('messages.navbar.contact') }}</a>
        </div>

        <div class="w-full h-auto flex flex-col gap-y-3 bg-secondary rounded-xl p-4 mt-6 sm:mt-8">
            <a href="tel:+51992764991"
                class="flex flex-row items-center gap-x-3 text-primary-dark hover:text-primary duration-300"
                aria-label="{{ __('messages.aria_labels.call') }}"
                title="{{ __('messages.titles.call') }}"
                >
                <x-heroicon-o-phone class="h-5 w-5 flex-shrink-0" />
                <span class="font-bold">+51 992 764 991</span>
            </a>
            <a href="mailto:operaciones@lanexsac.com"
                class="flex flex-row items-center gap-x-3 text-primary-dark hover:text-primary duration-300"
                aria-label="{{ __('messages.aria_labels.email') }}"
                title="{{ __('messages.titles.email') }}"
                >
                <x-heroicon-o-envelope class="h-5 w-5 flex-shrink-0" />
                <span class="font-bold break-all">operaciones@lanexsac.com</span>
            </a>
        </div>

        <a href={{ Auth::user() ? route('dashboard_home') : route('login') }}
            class="h-8 w-auto text-primary hover:text-primary-dark mr-auto my-4"
            aria-label="{{ Auth::user() ? __('messages.aria_labels.dashboard') : __('messages.aria_labels.login') }}"
            title="{{ Auth::user() ? __('messages.titles.dashboard') : __('messages.titles.login') }}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
        </a>

        <div class="w-auto h-auto
            flex flex-row justify-start gap-x-4 items-center mt-12">
            <x-button url="{{route('quote')}}" size="lg" text="{{ __('messages.common.quote') }}" extraClasses="px-6 py-2" />
            <x-button url="{{route('track')}}" size="lg" text="{{ __('messages.common.track') }}" extraClasses="px-6 py-2" />
        </div>

        <div class="flex flex-row gap-x-6 mt-auto text-primary">
            <a href="https://www.linkedin.com/company/expresslane-logistics-s-a-c/" target="_blank"
            aria-label="{{  __('messages.aria_labels.linkedin') }}"
            title="{{ __('messages.titles.linkedin') }}"
                >
                <x-bi-linkedin class="w-8 sm:w-12 h-8 sm:h-12" />
            </a>
            <a href="https://www.facebook.com/profile.php?id=61566765038948" target="_blank"
            aria-label="{{  __('messages.aria_labels.facebook') }}"
            title="{{ __('messages.titles.facebook') }}"
                >
                <x-bi-facebook class="w-8 sm:w-12 h-8 sm:h-12" />
            </a>
            <a href="https://www.instagram.com/expresslanelogisticssac" target="_blank"
            aria-label="{{  __('messages.aria_labels.instagram') }}"
            title="{{ __('messages.titles.instagram') }}"
                >
                <x-bi-instagram class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
            <a href="https://www.tiktok.com/@expresslanelogisticssac" target="_blank"

            aria-label="{{  __('messages.aria_labels.tiktok') }}"
            title="{{ __('messages.titles.tiktok') }}"
                >
                <x-bi-tiktok class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
        </div>
    </aside>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select the button and the menu
        const menuButtons = document.querySelectorAll('.navbar_menu_toggle_button');
        const menu = document.querySelector('#navbar_menu_scroll');

        // Toggle function to translate the div
        menuButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (menu.classList.contains('translate-x-[100%]')) {
                    menu.classList.add('translate-x-0');
                    menu.classList.remove('translate-x-[100%]');
                } else {
                    menu.classList.add('translate-x-[100%]');
                    menu.classList.remove('translate-x-0');
                }
            });
        })
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Function to toggle dropdowns based on clicked component
        document.querySelectorAll('.language-selector').forEach(selector => {
            selector.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const dropdown = document.querySelector(`#dropdown-options-${id}`);
                if(dropdown.classList.contains('hidden')){
                    dropdown.classList.remove('hidden');
                }else{
                    dropdown.classList.add('hidden');
                }
            });
        });
    })
</script>

