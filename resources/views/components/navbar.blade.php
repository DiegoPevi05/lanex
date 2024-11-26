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
                +51 992-764-991
            </label>
        </div>
        <div class="w-auto h-auto
            flex justify-center gap-x-4 items-center">
            <x-button url="{{route('quote')}}" text="{{ __('messages.common.quote') }}"  />
            <x-button url="{{route('track')}}" text="{{ __('messages.common.track') }}" variant="secondary" />
            <x-language-selector id="xl" />
            <a href={{ route('login') }} class="h-8 w-auto text-white hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
            </a>
        </div>
    </div>
    <div class="w-full mx-auto flex justify-between items-center bg-transparent xl:bg-white text-body px-6 sm:px-12 xl:px-20 h-[80px] max-sm:mt-6 max-xl:mt-12">
        <a href="{{ route('home') }}" class="w-full h-auto flex flex-row items-center">
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
        </a>
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
    <aside id="navbar_menu_scroll" class="fixed top-0 left-0 bottom-0 right-0 w-screen h-screen bg-white translate-x-[100%] transition-all duration-300 xl:hidden flex flex-col justify-start item-start px-8 py-10 sm:p-16">
        <div class="w-full flex justify-between items-center bg-transparent">
            <x-language-selector id="sm" />
            <span class="navbar_menu_toggle_button w-auto bg-primary p-2 rounded-xl shadow-md active:scale-95 duration-300 hover:bg-primary-dark">
                <x-heroicon-o-x-mark class="h-6 sm:h-12 w-6 sm:w-12 text-white" />
            </span>
        </div>
        <div class="w-full h-auto flex flex-between items-center mt-4">
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
        </div>
        <div class="w-auto h-auto flex flex-col gap-y-6 sm:gap-y-12 text-primary mt-6">
            <a href="{{ route('home')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.home') }}</h4></a>
            <a href="{{ route('about')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.aboutus') }}</h4></a>
            <a href="{{ route('services')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.services') }}</h4></a>
            <a href="{{ route('suppliers')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.suppliers') }}</h4></a>
            <a href="{{ route('contact')  }}"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer text-nowrap">{{ __('messages.navbar.contact') }}</h4></a>
        </div>

        <a href={{ route('login') }} class="h-8 w-auto text-primary hover:text-primary-dark mr-auto my-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
        </a>

        <div class="w-auto h-auto
            flex flex-row justify-start gap-x-4 items-center mt-12">
            <x-button url="{{route('quote')}}" size="lg" text="{{ __('messages.common.quote') }}" extraClasses="px-6 py-2" />
            <x-button url="{{route('track')}}" size="lg" text="{{ __('messages.common.track') }}" extraClasses="px-6 py-2" />
        </div>

        <div class="flex flex-row gap-x-6 mt-auto text-primary">
            <a href="https://www.linkedin.com/company/expresslane-logistics-s-a-c/" target="_blank">
                <x-bi-linkedin class="w-8 sm:w-12 h-8 sm:h-12" />
            </a>
            <a href="https://www.facebook.com/profile.php?id=61566765038948" target="_blank">
                <x-bi-facebook class="w-8 sm:w-12 h-8 sm:h-12" />
            </a>
            <a href="https://www.instagram.com/expresslanelogisticssac" target="_blank">
                <x-bi-instagram class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
            <a href="https://www.tiktok.com/@expresslanelogisticssac" target="_blank">
                <x-bi-tiktok class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
        </div>
    </aside>
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

