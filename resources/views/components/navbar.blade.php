<!-- resources/views/components/navbar.blade.php -->
<nav id="navbar" class="absolute top-0 left-0 right-0 w-full flex flex-col h-auto z-[60]">
    <div class="hidden xl:flex w-full justify-between items-center bg-primary-dark px-20 h-[60px]">
        <div class="w-auto h-auto
            divide-x divide-dashed
            flex justify-center items-center text-white">
            <label class="px-4">
                operaciones@lanex.com
            </label>
            <label class="px-4">
                +1 (333) 000-0000
            </label>
        </div>
        <div class="w-auto h-auto
            flex justify-center gap-x-4 items-center">
            <x-button url="{{route('quote')}}" text="{{ __('messages.common.quote') }}"  />
            <x-button url="{{route('track')}}" text="{{ __('messages.common.track') }}" variant="secondary" />
            <x-language-selector id="xl" />
        </div>
    </div>
    <div class="w-full mx-auto flex justify-between items-center bg-transparent xl:bg-white text-body px-6 sm:px-12 xl:px-20 h-[80px] max-xl:mt-12">
        <div class="w-full h-auto flex flex-row items-center">
            <div class="w-[60px] h-auto p-none">
                <img src="/images/logo.png" class="h-auto w-full" />
            </div>
            <div class="w-auto flex flex-row">
                <h2 class="font-bold text-primary">
                    Lan
                </h2>
                <h2 class="font-bold text-primary-dark">
                    Ex
                </h2>
            </div>
        </div>
        <div class="hidden xl:flex w-auto h-auto flex-row text-primary-dark">
            <div class="w-auto h-auto flex flex-row gap-x-4">
                <a href="{{ route('home')  }}"><label class="font-bold {{ request()->routeIs('home')  ? 'text-primary' : '' }} text-nowrap hover:text-primary duration-300 cursor-pointer">{{ __('messages.navbar.home') }}</label></a>
                <a href="{{ route('about')  }}"><label class="font-bold {{ request()->routeIs('about') ? 'text-primary' : '' }} text-nowrap hover:text-primary duration-300 cursor-pointer">{{ __('messages.navbar.aboutus') }}</label></a>
                <a href="{{ route('services')  }}"><label class="font-bold {{ request()->routeIs('services') || request()->routeIs('service') ? 'text-primary' : '' }} text-nowrap hover:text-primary duration-300 cursor-pointer">{{ __('messages.navbar.services') }}</label></a>
                <a href="{{ route('suppliers')  }}"><label class="font-bold {{ request()->routeIs('suppliers') || request()->routeIs('supplier') ? 'text-primary' : '' }} text-nowrap hover:text-primary duration-300 cursor-pointer">{{ __('messages.navbar.suppliers') }}</label></a>
                <a href="{{ route('contact')  }}"><label class="font-bold {{ request()->routeIs('contact') ? 'text-primary' : '' }} text-nowrap hover:text-primary duration-300 cursor-pointer">{{ __('messages.navbar.contact') }}</label></a>
            </div>
        </div>

        <div class="navbar_menu_toggle_button flex xl:hidden justify-center items-center bg-primary p-2 rounded-xl shadow-md active:scale-95 duration-300">
            <x-heroicon-o-bars-3 class="h-6 sm:h-12 w-6 sm:w-12 text-white" />
        </div>
    </div>
    <div id="navbar_menu_scroll" class="fixed top-0 left-0 bottom-0 right-0 w-screen h-screen bg-white translate-x-[100%] transition-all duration-300 xl:hidden flex flex-col justify-start item-start p-12 sm:p-16">
        <div class="navbar_menu_toggle_button ml-auto w-auto flex justify-center items-center bg-primary p-2 rounded-xl shadow-md active:scale-95 duration-300">
            <x-heroicon-o-x-mark class="h-6 sm:h-12 w-6 sm:w-12 text-white" />
        </div>
        <div class="w-full h-auto flex flex-between items-center">
            <div class="w-full h-auto flex flex-row items-center">
                <div class="w-[60px] h-auto p-none">
                    <img src="/images/logo.png" class="h-auto w-full" />
                </div>
                <div class="w-auto flex flex-row">
                    <h1 class="font-bold text-primary">
                        Lan
                    </h2>
                    <h1 class="font-bold text-primary-dark">
                        Ex
                    </h2>
                </div>
            </div>
            <x-language-selector id="sm" />
        </div>
        <div class="w-auto h-auto flex flex-col gap-y-6 sm:gap-y-12 text-primary mt-12">
            <a href="{{ route('home')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.home') }}</h4></a>
            <a href="{{ route('about')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.aboutus') }}</h4></a>
            <a href="{{ route('services')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.services') }}</h4></a>
            <a href="{{ route('suppliers')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.suppliers') }}</h4></a>
            <a href="{{ route('contact')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.contact') }}</h4></a>
        </div>
        <div class="w-auto h-auto
            flex flex-row justify-start gap-x-4 items-center mt-12">
            <x-button url="{{route('quote')}}" size="lg" text="{{ __('messages.common.quote') }}" extraClasses="px-12 py-2" />
            <x-button url="{{route('track')}}" size="lg" text="{{ __('messages.common.track') }}" extraClasses="px-12 py-2" />
        </div>
        <div class="flex flex-row gap-x-6 mt-auto text-primary">
            <a href="">
                <x-bi-facebook class="w-8 sm:w-12 h-8 sm:h-12" />
            </a>
            <a href="">
                <x-bi-instagram class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
            <a href="">
                <x-bi-twitter class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
            <a href="">
                <x-bi-tiktok class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
        </div>
    </div>
</nav>

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
</script>

