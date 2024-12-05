<div class="xl:hidden w-full h-auto flex flex-row items-center justify-start p-4">
    <span class="dashboard_button_toggle_sidebar h-10 w-10 flex items-center justify-center border-2 border-gray-light rounded-xl cursor-pointer hover:bg-primary-dark text-white bg-secondary-dark duration-300 p-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M3 12h18"/><path d="M3 18h18"/><path d="M3 6h18"/></svg>
    </span>
</div>

<div class="dashboard_menu_sidebar max-xl:fixed max-xl:top-0 max-xl:-left-[300px] max-xl:bottom-0 max-xl:right-0 max-xl:w-[300px] h-screen bg-white transition-all duration-300 xl:w-full xl:h-full flex flex-col justify-start items-start  py-4 gap-y-6 border-e-2 border-gray-light z-[120]">
    <div class="w-full h-auto flex flex-row justify-end px-4 xl:hidden">
        <span class="dashboard_button_toggle_sidebar h-10 w-10 flex items-center justify-center border-2 border-gray-light rounded-xl cursor-pointer hover:bg-primary-dark text-white bg-secondary-dark duration-300 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </span>
    </div>
    <a href="{{ route('home') }}" class="w-full h-auto flex flex-row items-center justify-center px-12">
        <div class="w-[60px] h-auto p-none">
            <img src="/images/logo.png" alt="logo" class="h-auto w-full" />
        </div>
        <div class="w-auto flex flex-row">
            <h3 class="font-bold text-primary">
                Lan
            </h3>
            <h3 class="font-bold text-primary-dark">
                Ex
            </h3>
        </div>
    </a>
    <div class="w-full flex flex-col items-start justify-center px-12">
        <div class="w-auto flex flex-row gap-x-2">
            <span class="font-bold text-primary">
                {{__('messages.dashboard.sidebar.greeting')}}
            </span>
            <span class="font-bold text-primary-dark capitalize">
                {{ Auth::user()->name }}
            </span>
        </div>
        <p class="text-body">
                {{__('messages.dashboard.sidebar.welcome')}}
        </p>
    </div>
    <ul class="w-full h-full flex flex-col gap-y-4">
        <li>
            <a href="{{ route('dashboard_home') }}"  class="text-body w-full flex flex-row gap-x-4 hover:text-primary cursor-pointer duration-300 active:scale-95 hover:bg-slate-100 px-12 py-4 {{ request()->routeIs('dashboard_home')  ? 'text-primary border-e-[3px] border-primary' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
              <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 0 1 8.25-8.25.75.75 0 0 1 .75.75v6.75H18a.75.75 0 0 1 .75.75 8.25 8.25 0 0 1-16.5 0Z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M12.75 3a.75.75 0 0 1 .75-.75 8.25 8.25 0 0 1 8.25 8.25.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75V3Z" clip-rule="evenodd" />
            </svg>
            <p class="capitalize font-bold text-sm">
                {{__('messages.dashboard.sidebar.home')}}
            </p>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard_order') }}" class="text-body w-full flex flex-row gap-x-4 hover:text-primary cursor-pointer duration-300 active:scale-95 hover:bg-slate-100 px-12 py-4 {{ request()->routeIs('dashboard_order')  ? 'text-primary border-e-[3px] border-primary' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M21 7h-3a2 2 0 0 1-2-2V2"/><path d="M21 6v6.5c0 .8-.7 1.5-1.5 1.5h-7c-.8 0-1.5-.7-1.5-1.5v-9c0-.8.7-1.5 1.5-1.5H17Z"/><path d="M7 8v8.8c0 .3.2.6.4.8.2.2.5.4.8.4H15"/><path d="M3 12v8.8c0 .3.2.6.4.8.2.2.5.4.8.4H11"/></svg>

            <p class="capitalize font-bold text-sm">
                {{__('messages.dashboard.sidebar.orders')}}
            </p>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard_client') }}" class="text-body w-full flex flex-row gap-x-4 hover:text-primary cursor-pointer duration-300 active:scale-95 hover:bg-slate-100 px-12 py-4 {{ request()->routeIs('dashboard_client')  ? 'text-primary border-e-[3px] border-primary' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <p class="capitalize font-bold text-sm">
                {{__('messages.dashboard.sidebar.clients')}}
            </p>
            </a>
        </li>

        <li>
            <a  href="{{ route('dashboard_history') }}"class="text-body w-full flex flex-row gap-x-4 hover:text-primary cursor-pointer duration-300 active:scale-95 hover:bg-slate-100 px-12 py-4 {{ request()->routeIs('dashboard_history')  ? 'text-primary border-e-[3px] border-primary' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M16 22h2a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><circle cx="8" cy="16" r="6"/><path d="M9.5 17.5 8 16.25V14"/></svg>
            <p class="capitalize font-bold text-sm">
                {{__('messages.dashboard.sidebar.history')}}
            </p>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard_billing') }}" class="text-body w-full flex flex-row gap-x-4 hover:text-primary cursor-pointer duration-300 active:scale-95 hover:bg-slate-100 px-12 py-4 {{ request()->routeIs('dashboard_billing')  ? 'text-primary border-e-[3px] border-primary' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
            <p class="capitalize font-bold text-sm">
                {{__('messages.dashboard.sidebar.billing')}}
            </p>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard_profile') }}" class="text-body w-full flex flex-row gap-x-4 hover:text-primary cursor-pointer duration-300 active:scale-95 hover:bg-slate-100 px-12 py-4 {{ request()->routeIs('dashboard_profile')  ? 'text-primary border-e-[3px] border-primary' : '' }}">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <p class="capitalize font-bold text-sm">
                {{__('messages.dashboard.sidebar.profile')}}
            </p>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard_web') }}" class="text-body w-full flex flex-row gap-x-4 hover:text-primary cursor-pointer duration-300 active:scale-95 hover:bg-slate-100 px-12 py-4 {{ request()->is('dashboard/web*')   ? 'text-primary border-e-[3px] border-primary' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M21.54 15H17a2 2 0 0 0-2 2v4.54"/><path d="M7 3.34V5a3 3 0 0 0 3 3a2 2 0 0 1 2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2c0-1.1.9-2 2-2h3.17"/><path d="M11 21.95V18a2 2 0 0 0-2-2a2 2 0 0 1-2-2v-1a2 2 0 0 0-2-2H2.05"/><circle cx="12" cy="12" r="10"/></svg>
            <p class="capitalize font-bold text-sm">
                {{__('messages.dashboard.sidebar.web')}}
            </p>
            </a>
        </li>

        <li class="mt-auto">
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="text-body w-full flex flex-row gap-x-4 hover:text-primary cursor-pointer duration-300 active:scale-95 hover:bg-slate-100 px-12 py-4 {{ request()->routeIs('dashboard_signout') ? 'text-primary border-e-[3px] border-primary' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <path d="M13 4h3a2 2 0 0 1 2 2v14"/>
                        <path d="M2 20h3"/>
                        <path d="M13 20h9"/>
                        <path d="M10 12v.01"/>
                        <path d="M13 4.562v16.157a1 1 0 0 1-1.242.97L5 20V5.562a2 2 0 0 1 1.515-1.94l4-1A2 2 0 0 1 13 4.561Z"/>
                    </svg>
                    <p class="capitalize font-bold text-sm">
                        {{ __('messages.dashboard.sidebar.signout') }}
                    </p>
                </button>
            </form>
        </li>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select the button and the menu
        const menuButtons = document.querySelectorAll('.dashboard_button_toggle_sidebar');
        const menu = document.querySelector('.dashboard_menu_sidebar');

        menuButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (menu.classList.contains('max-xl:-left-[300px]')) {
                    menu.classList.add('max-xl:-left-0');
                    menu.classList.remove('max-xl:-left-[300px]');
                } else {
                    menu.classList.add('max-xl:-left-[300px]');
                    menu.classList.remove('max-xl:-left-0');
                }
            });
        });
    });
</script>
