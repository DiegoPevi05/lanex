@extends('layouts.dashboard')

@section('content-dashboard')
    <section id="dashboard_history" class="bg-slate-50 h-full w-full flex flex-col p-4 sm:p-6 gap-5 overflow-y-auto">
        <div class="w-full flex-1 flex flex-col bg-white border border-slate-200/90 rounded-2xl shadow-sm p-5 overflow-hidden">
            <div class="w-full flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <span class="h-10 w-10 rounded-xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 22h2a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><circle cx="8" cy="16" r="6"/><path d="M9.5 17.5 8 16.25V14"/></svg>
                    </span>
                    <div>
                        <span class="text-[11px] font-mono uppercase tracking-widest text-primary block">
                            REGISTRO HISTÓRICO DE CARGA
                        </span>
                        <h1 class="text-lg sm:text-xl font-bold text-slate-900 capitalize font-display">
                            {{ __('messages.dashboard.history.name') }}
                        </h1>
                    </div>
                </div>
                <span class="text-xs font-mono font-semibold text-slate-500">
                    Total: {{ $pagination->total() }}
                </span>
            </div>

            <div id="order-cards-container" class="w-full flex-1 flex flex-col justify-start items-start overflow-y-auto gap-4 pr-1">
                @forelse ($pagination->items() as $paginate)
                    <x-order-card :data="$paginate" type="history"/>
                @empty
                    <div class="w-full flex-1 flex flex-col items-center justify-center text-center py-12 px-4 border border-dashed border-slate-200 rounded-xl bg-slate-50/50">
                        <p class="text-sm font-bold text-slate-800 mb-1">Sin órdenes archivadas en el historial</p>
                        <p class="text-xs text-slate-500">Las órdenes completadas o canceladas aparecerán aquí para consulta o restauración.</p>
                    </div>
                @endforelse
            </div>

            <div class="w-full flex items-center justify-between pt-4 mt-4 border-t border-slate-100">
                <div class="flex items-center gap-1.5">
                    <a href="{{ route('dashboard_history', ['page' => 1]) }}" class="{{ $pagination->currentPage() == 1 ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                    </a>
                    <a href="{{ route('dashboard_history', ['page' => $pagination->currentPage() - 1]) }}" class="{{ $pagination->currentPage() == 1 ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                </div>

                <span class="text-xs font-mono text-slate-500">
                    Página {{ $pagination->currentPage() }} de {{ max(1, $pagination->lastPage()) }}
                </span>

                <div class="flex items-center gap-1.5">
                    <a href="{{ route('dashboard_history', ['page' => $pagination->currentPage() + 1]) }}" class="{{ $pagination->lastPage() == $pagination->currentPage() ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                    <a href="{{ route('dashboard_history', ['page' => $pagination->lastPage()]) }}" class="{{ $pagination->lastPage() == $pagination->currentPage() ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <x-order-status-modal/>
    <x-order-custom-email-modal/>
    <x-order-restore-modal/>
@endsection
