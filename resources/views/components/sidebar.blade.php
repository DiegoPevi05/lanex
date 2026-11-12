<!-- Mobile Top Header Bar -->
<div class="xl:hidden w-full h-14 bg-slate-950 text-white border-b border-slate-800 flex items-center justify-between px-4 shrink-0">
    <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
        <img src="/images/logo.png" alt="LanEx" class="h-7 w-7 object-contain" />
        <span class="text-lg font-extrabold tracking-tight font-display">
            <span class="text-purple-400">Lan</span><span class="text-white">Ex</span>
        </span>
        <span class="text-[10px] font-mono uppercase tracking-wider px-2 py-0.5 rounded bg-purple-500/20 text-purple-300 border border-purple-500/30">
            Admin
        </span>
    </a>

    <button type="button" aria-label="Abrir menú lateral" class="dashboard_button_toggle_sidebar h-9 w-9 flex items-center justify-center rounded-lg border border-slate-800 bg-slate-900 text-slate-200 hover:bg-primary hover:border-primary hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18"/><path d="M3 18h18"/><path d="M3 6h18"/></svg>
    </button>
</div>

<!-- Sidebar Navigation Drawer -->
<aside class="dashboard_menu_sidebar max-xl:fixed max-xl:top-0 max-xl:-left-[300px] max-xl:bottom-0 max-xl:w-[280px] h-screen bg-slate-950 text-slate-300 transition-all duration-300 xl:w-64 xl:h-full flex flex-col justify-between border-r border-slate-800/90 z-[120] select-none">
    <!-- Top Brand & Operator Info -->
    <div class="p-5 border-b border-slate-800/80">
        <div class="flex items-center justify-between">
            <a href="{{ route('dashboard_home') }}" class="inline-flex items-center gap-2.5 group">
                <img src="/images/logo.png" alt="LanEx" class="h-8 w-8 object-contain" />
                <div class="flex flex-col">
                    <span class="text-xl font-extrabold tracking-tight leading-none font-display">
                        <span class="text-purple-400">Lan</span><span class="text-white">Ex</span>
                    </span>
                    <span class="text-[10px] font-mono uppercase tracking-widest text-slate-400 mt-0.5">
                        CONSOLA SOUL
                    </span>
                </div>
            </a>

            <button type="button" aria-label="Cerrar menú lateral" class="dashboard_button_toggle_sidebar xl:hidden h-8 w-8 flex items-center justify-center rounded-lg border border-slate-800 bg-slate-900 text-slate-300 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <!-- Logged-in Operator Pill -->
        <div class="mt-4 p-3 rounded-xl bg-slate-900/90 border border-slate-800/90 flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-purple-600/20 border border-purple-500/40 flex items-center justify-center text-purple-300 font-bold text-sm uppercase shrink-0">
                {{ mb_substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-bold text-white truncate capitalize">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-[11px] text-slate-400 truncate">
                    {{ Auth::user()->email }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-6 no-scroll-bar">
        <div>
            <p class="px-3 mb-2 text-[10px] font-mono uppercase tracking-widest text-slate-400">
                Operaciones Logísticas
            </p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard_home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_home') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                        <span class="capitalize">{{ __('messages.dashboard.sidebar.home') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard_order') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_order') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 7h-3a2 2 0 0 1-2-2V2"/><path d="M21 6v6.5c0 .8-.7 1.5-1.5 1.5h-7c-.8 0-1.5-.7-1.5-1.5v-9c0-.8.7-1.5 1.5-1.5H17Z"/><path d="M7 8v8.8c0 .3.2.6.4.8.2.2.5.4.8.4H15"/><path d="M3 12v8.8c0 .3.2.6.4.8.2.2.5.4.8.4H11"/></svg>
                        <span class="capitalize">{{ __('messages.dashboard.sidebar.orders') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard_client') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_client') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <span class="capitalize">{{ __('messages.dashboard.sidebar.clients') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard_transport_type') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_transport_type') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        <span class="capitalize">Tipos de Transporte</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard_history') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_history') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 22h2a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><circle cx="8" cy="16" r="6"/><path d="M9.5 17.5 8 16.25V14"/></svg>
                        <span class="capitalize">{{ __('messages.dashboard.sidebar.history') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard_billing') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_billing') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                        <span class="capitalize">{{ __('messages.dashboard.sidebar.billing') }}</span>
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <p class="px-3 mb-2 text-[10px] font-mono uppercase tracking-widest text-slate-400">
                Portal &amp; Cuenta
            </p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard_web') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->is('dashboard/web*') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        <span class="capitalize">{{ __('messages.dashboard.sidebar.web') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard_subscribers') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_subscribers*') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <span>Suscriptores</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard_user') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_user*') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <span>Usuarios</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard_profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_profile') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span class="capitalize">{{ __('messages.dashboard.sidebar.profile') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard_settings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard_settings*') ? 'bg-primary text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                        <span>Configuración</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('home') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-400 hover:bg-slate-900 hover:text-white transition-all">
                        <span class="inline-flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            <span>Ver Sitio Web</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Bottom Logout -->
    <div class="p-3 border-t border-slate-800/80">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-300 hover:bg-red-500/15 hover:text-red-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" x2="9" y1="12" y2="12"/>
                </svg>
                <span class="capitalize">{{ __('messages.dashboard.sidebar.signout') }}</span>
            </button>
        </form>
    </div>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
