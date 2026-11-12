@extends('layouts.dashboard')

@section('content-dashboard')
    <section id="dashboard_web" class="bg-slate-50 h-full w-full flex flex-col p-4 sm:p-6 gap-5 overflow-y-auto">
        <!-- Header Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl px-6 py-5 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-[11px] font-mono uppercase tracking-widest text-primary block">
                    ADMINISTRACIÓN DEL PORTAL PÚBLICO
                </span>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight font-display capitalize">
                    {{ __('messages.dashboard.web.header') }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 mt-0.5">
                    {{ __('messages.dashboard.web.indications') }}
                </p>
            </div>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 h-10 px-4 rounded-xl border border-slate-300 hover:border-slate-900 bg-white text-slate-700 hover:text-slate-900 text-xs font-semibold transition-colors shrink-0">
                <span>Abrir Sitio Público</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
            </a>
        </div>

        <!-- CMS Modules Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 animation-group">
            <a id="web-content-option-services" href="{{ route('dashboard_web_service') }}" class="group bg-white rounded-2xl border border-slate-200/90 hover:border-primary p-6 shadow-sm transition-all flex flex-col justify-between gap-4">
                <div class="flex items-start justify-between">
                    <span class="h-11 w-11 rounded-xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-400 group-hover:text-primary">Módulo 01</span>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900 group-hover:text-primary capitalize mb-1">
                        {{ __('messages.dashboard.web.card.services') }}
                    </h2>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Configura las páginas de servicios logísticos, puntos clave, preguntas frecuentes e imágenes de cabecera.
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                    <span>Gestionar servicios</span>
                    <span>→</span>
                </div>
            </a>

            <a id="web-content-option-suppliers" href="{{ route('dashboard_web_supplier') }}" class="group bg-white rounded-2xl border border-slate-200/90 hover:border-primary p-6 shadow-sm transition-all flex flex-col justify-between gap-4">
                <div class="flex items-start justify-between">
                    <span class="h-11 w-11 rounded-xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"/><path d="M6 18h12"/><path d="M6 14h12"/><rect width="12" height="12" x="6" y="10"/></svg>
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-400 group-hover:text-primary">Módulo 02</span>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900 group-hover:text-primary capitalize mb-1">
                        {{ __('messages.dashboard.web.card.suppliers') }}
                    </h2>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Administra el directorio de fabricantes y marcas verificadas que se muestran en el catálogo público.
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                    <span>Gestionar proveedores</span>
                    <span>→</span>
                </div>
            </a>

            <a id="web-content-option-products" href="{{ route('dashboard_web_product') }}" class="group bg-white rounded-2xl border border-slate-200/90 hover:border-primary p-6 shadow-sm transition-all flex flex-col justify-between gap-4">
                <div class="flex items-start justify-between">
                    <span class="h-11 w-11 rounded-xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9Z"/><path d="m3 9 2.45-4.9A2 2 0 0 1 7.24 3h9.52a2 2 0 0 1 1.8 1.1L21 9"/><path d="M12 3v6"/></svg>
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-400 group-hover:text-primary">Módulo 03</span>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900 group-hover:text-primary capitalize mb-1">
                        {{ __('messages.dashboard.web.card.products') }}
                    </h2>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Actualiza productos asociados a los proveedores, categorías de importación y fichas de referencia.
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                    <span>Gestionar productos</span>
                    <span>→</span>
                </div>
            </a>

            <a id="web-content-option-blogs" href="{{ route('dashboard_web_blog') }}" class="group bg-white rounded-2xl border border-slate-200/90 hover:border-primary p-6 shadow-sm transition-all flex flex-col justify-between gap-4">
                <div class="flex items-start justify-between">
                    <span class="h-11 w-11 rounded-xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><polyline points="11 3 11 11 14 8 17 11 17 3"/></svg>
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-400 group-hover:text-primary">Módulo 04</span>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900 group-hover:text-primary capitalize mb-1">
                        {{ __('messages.dashboard.web.card.blogs') }}
                    </h2>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Redacta y publica artículos sobre comercio exterior, normativas SUNAT y guías de importación.
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                    <span>Gestionar artículos</span>
                    <span>→</span>
                </div>
            </a>

            <a id="web-content-option-reviews" href="{{ route('dashboard_web_review') }}" class="group bg-white rounded-2xl border border-slate-200/90 hover:border-primary p-6 shadow-sm transition-all flex flex-col justify-between gap-4">
                <div class="flex items-start justify-between">
                    <span class="h-11 w-11 rounded-xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-slate-400 group-hover:text-primary">Módulo 05</span>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900 group-hover:text-primary capitalize mb-1">
                        {{ __('messages.dashboard.web.card.reviews') }}
                    </h2>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Administra los testimonios y valoraciones de clientes corporativos destacados en el portal.
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-primary">
                    <span>Gestionar reseñas</span>
                    <span>→</span>
                </div>
            </a>
        </div>
    </section>
@endsection
