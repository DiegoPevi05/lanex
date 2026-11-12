@extends('layouts.dashboard')

@section('content-dashboard')
    @php
        $items = $pagination->items();
        $pageNetTotal = collect($items)->sum('net_amount');
        $pageCostTotal = collect($items)->sum('operative_cost');
        $pageMargin = $pageNetTotal - $pageCostTotal;
    @endphp

    <section id="dashboard_billing" class="bg-slate-50 h-full w-full flex flex-col p-4 sm:p-6 gap-5 overflow-y-auto">
        <!-- Top Header & Financial Summary -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-sm flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="h-11 w-11 rounded-xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                </span>
                <div>
                    <span class="text-[11px] font-mono uppercase tracking-widest text-primary block">
                        CONTROL FINANCIERO DE OPERACIONES
                    </span>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight font-display capitalize">
                        {{ __('messages.dashboard.sidebar.billing') }}
                    </h1>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3 sm:gap-4">
                <div class="px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200/80">
                    <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500 block">Monto Neto (Pág.)</span>
                    <span class="text-sm sm:text-base font-bold text-slate-900 font-mono tabular-nums">$ {{ number_format($pageNetTotal, 2) }}</span>
                </div>
                <div class="px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200/80">
                    <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500 block">Costo Operativo</span>
                    <span class="text-sm sm:text-base font-bold text-slate-700 font-mono tabular-nums">$ {{ number_format($pageCostTotal, 2) }}</span>
                </div>
                <div class="px-4 py-2.5 rounded-xl bg-purple-50/70 border border-purple-200/80">
                    <span class="text-[10px] font-mono uppercase tracking-wider text-primary block">Margen Operativo</span>
                    <span class="text-sm sm:text-base font-bold text-primary font-mono tabular-nums">$ {{ number_format($pageMargin, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Billing Table Card -->
        <div class="w-full flex-1 flex flex-col bg-white border border-slate-200/90 rounded-2xl shadow-sm p-5 overflow-hidden">
            <div id="order-cards-container" class="w-full flex-1 overflow-x-auto overflow-y-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50/80 text-[11px] font-mono uppercase tracking-wider text-slate-500">
                            <th class="py-3.5 px-4 font-semibold">{{ __('messages.dashboard.order.form.fields.order_number') }}</th>
                            <th class="py-3.5 px-4 font-semibold max-sm:hidden">{{ __('messages.dashboard.order.form.fields.client_id') }}</th>
                            <th class="py-3.5 px-4 font-semibold max-sm:hidden">{{ __('messages.dashboard.order.form.fields.status') }}</th>
                            <th class="py-3.5 px-4 font-semibold text-right">{{ __('messages.dashboard.order.form.fields.net_amount') }}</th>
                            <th class="py-3.5 px-4 font-semibold text-right">{{ __('messages.dashboard.order.form.fields.operative_cost') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($items as $order)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 px-4 font-mono font-bold text-slate-900">
                                    {{ $order->order_number }}
                                </td>
                                <td class="py-3.5 px-4 text-slate-700 font-medium max-sm:hidden">
                                    {{ $order->client_name }}
                                </td>
                                <td class="py-3.5 px-4 max-sm:hidden">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/80">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        {{ __('messages.dashboard.order.form.fields.' . $order->status) }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right font-mono font-semibold text-slate-900 tabular-nums">
                                    $ {{ number_format($order->net_amount, 2) }}
                                </td>
                                <td class="py-3.5 px-4 text-right font-mono text-slate-600 tabular-nums">
                                    $ {{ number_format($order->operative_cost, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-sm text-slate-500">
                                    No se registran órdenes completadas para facturación en este momento.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="w-full flex items-center justify-between pt-4 mt-4 border-t border-slate-100">
                <div class="flex items-center gap-1.5">
                    <a href="{{ route('dashboard_billing', ['page' => 1]) }}" class="{{ $pagination->currentPage() == 1 ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                    </a>
                    <a href="{{ route('dashboard_billing', ['page' => $pagination->currentPage() - 1]) }}" class="{{ $pagination->currentPage() == 1 ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                </div>

                <span class="text-xs font-mono text-slate-500">
                    Página {{ $pagination->currentPage() }} de {{ max(1, $pagination->lastPage()) }}
                </span>

                <div class="flex items-center gap-1.5">
                    <a href="{{ route('dashboard_billing', ['page' => $pagination->currentPage() + 1]) }}" class="{{ $pagination->lastPage() == $pagination->currentPage() ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                    <a href="{{ route('dashboard_billing', ['page' => $pagination->lastPage()]) }}" class="{{ $pagination->lastPage() == $pagination->currentPage() ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
