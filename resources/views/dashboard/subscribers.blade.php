@extends('layouts.dashboard')

@section('content-dashboard')
<section id="dashboard_subscribers" class="bg-slate-50 h-full w-full flex flex-col p-4 sm:p-6 lg:p-8 gap-6 overflow-y-auto">
    <div class="max-w-7xl w-full mx-auto space-y-6">

        <!-- Header Card with Stats -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-purple-50 text-primary border border-purple-200/70 text-[11px] font-mono uppercase tracking-wider mb-2">
                        Comunicaciones &amp; Marketing
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-display tracking-tight">
                        Suscriptores al Boletín
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Visualiza los usuarios suscritos en la web y envía correos masivos / boletines informativos directos.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="p-3 sm:px-5 sm:py-2.5 rounded-xl bg-purple-50 border border-purple-200 text-center">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-purple-700 block">Total Suscriptores</span>
                        <span class="text-xl sm:text-2xl font-black text-primary font-mono">{{ $totalCount }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success & Error Alerts -->
        @if (session('status'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                <div class="flex-1">
                    <p class="font-bold text-emerald-800">{{ session('status') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                <div class="flex-1">
                    <p class="font-bold text-rose-800">Se encontraron problemas:</p>
                    <ul class="text-xs mt-1 text-rose-700 list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- Left Col: Subscribers List (7 cols) -->
            <div class="lg:col-span-7 space-y-4">
                <div class="bg-white border border-slate-200/90 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <div>
                            <h2 class="text-base font-bold text-slate-900 font-display">
                                Directorio de Suscriptores
                            </h2>
                            <p class="text-xs text-slate-500">Contactos que completaron el formulario en el pie de página.</p>
                        </div>

                        <form action="{{ route('dashboard_subscribers') }}" method="GET" class="w-full sm:w-60 relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </span>
                            <input
                                type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Buscar correo..."
                                class="w-full h-9 pl-9 pr-3 text-xs rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:outline-none transition-all"
                            >
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50/80 border-b border-slate-200/80 text-slate-500 font-mono uppercase tracking-wider">
                                <tr>
                                    <th class="py-3 px-4 sm:px-5">#</th>
                                    <th class="py-3 px-4">Correo Electrónico</th>
                                    <th class="py-3 px-4">Fecha de Alta</th>
                                    <th class="py-3 px-4 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                @forelse ($subscribers as $subscriber)
                                    <tr class="hover:bg-slate-50/60 transition-colors">
                                        <td class="py-3 px-4 sm:px-5 font-mono text-[11px] text-slate-400">
                                            #{{ $subscriber->id }}
                                        </td>
                                        <td class="py-3 px-4 font-semibold text-slate-900">
                                            {{ $subscriber->email }}
                                        </td>
                                        <td class="py-3 px-4 text-slate-500 font-mono text-[11px]">
                                            {{ optional($subscriber->created_at)->format('d/m/Y H:i') ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <form action="{{ route('subscribers.destroy', $subscriber->id) }}" method="POST" onsubmit="return confirm('¿Eliminar a {{ $subscriber->email }} de la lista de suscriptores?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="p-1.5 rounded-lg border border-red-200 hover:bg-red-50 text-red-600 transition-colors"
                                                    title="Eliminar Suscriptor"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-10 text-slate-500">
                                            No hay suscriptores registrados todavía.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($subscribers->hasPages())
                        <div class="p-3 border-t border-slate-100 bg-slate-50/50">
                            {{ $subscribers->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Col: Mass Email / Newsletter Composer (5 cols) -->
            <div class="lg:col-span-5">
                <div class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-7 shadow-sm space-y-5">
                    <div class="pb-3 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="inline-flex items-center gap-1.5 text-primary text-[10px] font-mono uppercase tracking-widest font-bold">
                                Envío Masivo
                            </span>
                            <h2 class="text-lg font-bold text-slate-900 font-display">
                                Redactar Boletín
                            </h2>
                        </div>
                        <span class="text-xs px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-mono font-bold">
                            {{ $totalCount }} destino(s)
                        </span>
                    </div>

                    <form action="{{ route('subscribers.newsletter') }}" method="POST" class="space-y-4" onsubmit="return confirm('¿Confirmas que deseas enviar este boletín por correo a todos los {{ $totalCount }} suscriptores?');">
                        @csrf

                        <div>
                            <label for="newsletter_subject" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Asunto del Correo *
                            </label>
                            <input
                                type="text"
                                id="newsletter_subject"
                                name="subject"
                                required
                                value="{{ old('subject') }}"
                                placeholder="Ej: Nuevas rutas marítimas y actualización de tarifas LanEx"
                                class="w-full h-11 px-3.5 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none transition-all"
                            >
                        </div>

                        <div>
                            <label for="newsletter_title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Título / Saludo Principal *
                            </label>
                            <input
                                type="text"
                                id="newsletter_title"
                                name="title"
                                required
                                value="{{ old('title', '¡Hola! Te compartimos novedades de comercio exterior') }}"
                                placeholder="Título en cabecera del correo"
                                class="w-full h-11 px-3.5 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none transition-all"
                            >
                        </div>

                        <div>
                            <label for="newsletter_content" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Mensaje / Contenido *
                            </label>
                            <textarea
                                id="newsletter_content"
                                name="content"
                                rows="6"
                                required
                                placeholder="Escribe el contenido del boletín. Cada salto de línea será presentado como un párrafo formal..."
                                class="w-full p-3.5 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none transition-all leading-relaxed"
                            >{{ old('content') }}</textarea>
                            <p class="text-[11px] text-slate-400 mt-1">Se respetarán los saltos de línea como párrafos independientes.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div>
                                <label for="newsletter_action_text" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Texto Botón (Opcional)
                                </label>
                                <input
                                    type="text"
                                    id="newsletter_action_text"
                                    name="action_text"
                                    value="{{ old('action_text') }}"
                                    placeholder="Ej: Ver Servicios"
                                    class="w-full h-10 px-3 text-xs rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none"
                                >
                            </div>

                            <div>
                                <label for="newsletter_action_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Enlace Botón (Opcional)
                                </label>
                                <input
                                    type="url"
                                    id="newsletter_action_url"
                                    name="action_url"
                                    value="{{ old('action_url') }}"
                                    placeholder="https://lanexsac.com/..."
                                    class="w-full h-10 px-3 text-xs rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none"
                                >
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-100">
                            <button
                                type="submit"
                                @if($totalCount === 0) disabled @endif
                                class="w-full h-12 rounded-xl bg-primary hover:bg-primary-dark disabled:opacity-50 disabled:cursor-not-allowed text-white font-semibold text-sm shadow-sm transition-all inline-flex items-center justify-center gap-2"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                <span>Enviar Boletín a {{ $totalCount }} Suscriptor(es)</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection
