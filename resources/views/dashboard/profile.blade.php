@extends('layouts.dashboard')

@section('content-dashboard')
    <section id="dashboard_profile" class="bg-slate-50 h-full w-full flex flex-col p-4 sm:p-6 gap-5 overflow-y-auto">
        <div class="max-w-4xl w-full mx-auto space-y-5">
            <!-- Profile Banner Card -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary text-white flex items-center justify-center text-2xl font-extrabold uppercase font-display shadow-sm">
                            {{ mb_substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-purple-50 text-primary border border-purple-200/70 text-[11px] font-mono uppercase tracking-wider mb-1">
                                Operador Administrativo Autorizado
                            </span>
                            <h1 class="text-2xl font-bold text-slate-900 capitalize font-display">
                                {{ Auth::user()->name }}
                            </h1>
                            <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 h-10 px-4 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-semibold transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                            <span>{{ __('messages.dashboard.sidebar.signout') }}</span>
                        </button>
                    </form>
                </div>

                <!-- Account Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70">
                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-500 block mb-1">ID de Operador</span>
                        <span class="text-sm font-bold text-slate-900 font-mono">#OP-{{ str_pad(Auth::user()->id ?? 1, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70">
                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-500 block mb-1">Correo Corporativo</span>
                        <span class="text-sm font-bold text-slate-900 truncate block">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70">
                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-500 block mb-1">Fecha de Alta</span>
                        <span class="text-sm font-bold text-slate-900 font-mono">{{ optional(Auth::user()->created_at)->format('d/m/Y') ?? date('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Shortcuts -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('dashboard_order') }}" class="bg-white border border-slate-200/90 hover:border-primary rounded-2xl p-5 shadow-sm transition-all group">
                    <p class="text-xs font-mono uppercase tracking-wider text-primary mb-1">Acceso Directo</p>
                    <p class="text-base font-bold text-slate-900 group-hover:text-primary mb-1">Gestión de Órdenes</p>
                    <p class="text-xs text-slate-500">Crear y actualizar estados de carga.</p>
                </a>
                <a href="{{ route('dashboard_client') }}" class="bg-white border border-slate-200/90 hover:border-primary rounded-2xl p-5 shadow-sm transition-all group">
                    <p class="text-xs font-mono uppercase tracking-wider text-primary mb-1">Acceso Directo</p>
                    <p class="text-base font-bold text-slate-900 group-hover:text-primary mb-1">Directorio de Clientes</p>
                    <p class="text-xs text-slate-500">Administrar empresas y RUC.</p>
                </a>
                <a href="{{ route('dashboard_web') }}" class="bg-white border border-slate-200/90 hover:border-primary rounded-2xl p-5 shadow-sm transition-all group">
                    <p class="text-xs font-mono uppercase tracking-wider text-primary mb-1">Acceso Directo</p>
                    <p class="text-base font-bold text-slate-900 group-hover:text-primary mb-1">Contenido Web</p>
                    <p class="text-xs text-slate-500">Servicios, proveedores y blogs.</p>
                </a>
            </div>
        </div>
    </section>
@endsection
