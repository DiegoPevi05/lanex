@extends('layouts.dashboard')

@section('content-dashboard')
    <section id="dashboard_home" class="bg-slate-50 h-full w-full flex flex-col p-4 sm:p-6 gap-5 overflow-y-auto">
        <!-- Top Operational Header & Quick Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white border border-slate-200/90 rounded-2xl px-6 py-4 shadow-sm shrink-0">
            <div>
                <span class="text-[11px] font-mono uppercase tracking-widest text-primary block">
                    CONSOLA CENTRAL · SOUL LANEX
                </span>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight font-display">
                    Resumen Operativo y Financiero
                </h1>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-purple-50 border border-purple-200/80 text-xs font-semibold text-primary">
                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                    <span>{{ $pagination->total() }} {{ __('messages.dashboard.home.active_orders') }}</span>
                </div>
                <a href="{{ route('dashboard_order') }}" class="inline-flex items-center gap-2 h-9 px-4 rounded-xl bg-primary hover:bg-primary-dark text-white text-xs font-semibold transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    <span>Gestionar Órdenes</span>
                </a>
                <a href="{{ route('dashboard_client') }}" class="inline-flex items-center gap-2 h-9 px-3.5 rounded-xl border border-slate-300 hover:border-slate-900 bg-white text-slate-700 hover:text-slate-900 text-xs font-semibold transition-colors">
                    <span>Clientes</span>
                </a>
            </div>
        </div>

        <!-- Main 2-Column Dashboard Grid -->
        <div class="w-full flex-1 min-h-0 grid grid-cols-1 lg:grid-cols-12 gap-5">
            <!-- Left Column: Active Orders Feed -->
            <div class="lg:col-span-6 flex flex-col bg-white border border-slate-200/90 rounded-2xl shadow-sm p-5 min-h-[420px]">
                <div class="w-full flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <span class="h-9 w-9 rounded-xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        </span>
                        <div>
                            <h2 class="text-base font-bold text-slate-900 capitalize leading-tight">
                                {{ __('messages.dashboard.home.active_orders') }}
                            </h2>
                            <p class="text-xs text-slate-500">Monitoreo de etapas y despacho en tiempo real</p>
                        </div>
                    </div>
                    <span class="text-xs font-mono font-semibold text-slate-500">
                        Pág. {{ $pagination->currentPage() }} / {{ max(1, $pagination->lastPage()) }}
                    </span>
                </div>

                <div id="order-cards-container" class="w-full flex-1 flex flex-col justify-start items-start overflow-y-auto gap-4 pr-1">
                    @forelse ($pagination->items() as $paginate)
                        <x-order-card :data="$paginate" type="dashboard"/>
                    @empty
                        <div class="w-full flex-1 flex flex-col items-center justify-center text-center py-12 px-4 border border-dashed border-slate-200 rounded-xl bg-slate-50/50">
                            <div class="w-12 h-12 rounded-xl bg-purple-50 text-primary flex items-center justify-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m16 16 2 2 4-4"/><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
                            </div>
                            <p class="text-sm font-bold text-slate-800 mb-1">Sin órdenes activas en tránsito</p>
                            <p class="text-xs text-slate-500 mb-4 max-w-xs">Registra una nueva orden desde el módulo de Órdenes para iniciar el seguimiento operativo.</p>
                            <a href="{{ route('dashboard_order') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary text-white text-xs font-semibold hover:bg-primary-dark transition-colors">
                                <span>Ir a Órdenes</span>
                            </a>
                        </div>
                    @endforelse
                </div>

                <div class="w-full flex items-center justify-between pt-4 mt-4 border-t border-slate-100">
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('dashboard_home', ['page' => 1]) }}" class="{{ $pagination->currentPage() == 1 ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                        </a>
                        <a href="{{ route('dashboard_home', ['page' => $pagination->currentPage() - 1]) }}" class="{{ $pagination->currentPage() == 1 ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                        </a>
                    </div>

                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('dashboard_home', ['page' => $pagination->currentPage() + 1]) }}" class="{{ $pagination->lastPage() == $pagination->currentPage() ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                        <a href="{{ route('dashboard_home', ['page' => $pagination->lastPage()]) }}" class="{{ $pagination->lastPage() == $pagination->currentPage() ? 'bg-slate-100 text-slate-300 border-slate-200 pointer-events-none' : 'bg-white text-slate-700 border-slate-300 hover:bg-primary hover:border-primary hover:text-white' }} h-9 w-9 border rounded-xl flex items-center justify-center transition-colors p-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Operational & Revenue Analytics -->
            <div class="lg:col-span-6 flex flex-col gap-5">
                <!-- Chart 1: Delivered / Active Orders -->
                <div class="flex-1 flex flex-col bg-white border border-slate-200/90 rounded-2xl shadow-sm p-5">
                    <div class="w-full flex flex-wrap items-center justify-between gap-3 pb-3 mb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <span class="h-8 w-8 rounded-lg bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg>
                            </span>
                            <h3 class="text-sm font-bold text-slate-900 capitalize">
                                {{ __('messages.dashboard.home.delivered_orders') }}
                            </h3>
                        </div>

                        <div class="inline-flex items-center bg-slate-100 p-1 rounded-xl gap-1">
                            <label class="cursor-pointer">
                                <input type="radio" name="search_period_orders" value="weekly" class="hidden peer" checked/>
                                <span class="peer-checked:bg-primary peer-checked:text-white px-2.5 py-1 rounded-lg text-xs font-semibold text-slate-600 transition-colors block">
                                    {{ __('messages.dashboard.home.weekly') }}
                                </span>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="search_period_orders" value="monthly" class="hidden peer" />
                                <span class="peer-checked:bg-primary peer-checked:text-white px-2.5 py-1 rounded-lg text-xs font-semibold text-slate-600 transition-colors block">
                                    {{ __('messages.dashboard.home.months') }}
                                </span>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="search_period_orders" value="yearly" class="hidden peer" />
                                <span class="peer-checked:bg-primary peer-checked:text-white px-2.5 py-1 rounded-lg text-xs font-semibold text-slate-600 transition-colors block">
                                    {{ __('messages.dashboard.home.years') }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="relative w-full flex-1 min-h-[180px]">
                        <canvas id="graph_delivered_orders" class="w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Chart 2: Net Amount Evolution -->
                <div class="flex-1 flex flex-col bg-white border border-slate-200/90 rounded-2xl shadow-sm p-5">
                    <div class="w-full flex flex-wrap items-center justify-between gap-3 pb-3 mb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <span class="h-8 w-8 rounded-lg bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            </span>
                            <h3 class="text-sm font-bold text-slate-900 capitalize">
                                {{ __('messages.dashboard.home.net_amount') }}
                            </h3>
                        </div>

                        <div class="inline-flex items-center bg-slate-100 p-1 rounded-xl gap-1">
                            <label class="cursor-pointer">
                                <input type="radio" name="search_period_amount" value="weekly" class="hidden peer" checked/>
                                <span class="peer-checked:bg-primary peer-checked:text-white px-2.5 py-1 rounded-lg text-xs font-semibold text-slate-600 transition-colors block">
                                    {{ __('messages.dashboard.home.weekly') }}
                                </span>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="search_period_amount" value="monthly" class="hidden peer" />
                                <span class="peer-checked:bg-primary peer-checked:text-white px-2.5 py-1 rounded-lg text-xs font-semibold text-slate-600 transition-colors block">
                                    {{ __('messages.dashboard.home.months') }}
                                </span>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="search_period_amount" value="yearly" class="hidden peer" />
                                <span class="peer-checked:bg-primary peer-checked:text-white px-2.5 py-1 rounded-lg text-xs font-semibold text-slate-600 transition-colors block">
                                    {{ __('messages.dashboard.home.years') }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="relative w-full flex-1 min-h-[180px]">
                        <canvas id="graph_amount_net_amount" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-order-status-modal/>
    <x-order-custom-email-modal/>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let order_search_criteria = 'weekly';

        document.querySelectorAll('input[name="search_period_orders"]').forEach((input) => {
            input.addEventListener('change', (event) => {
                order_search_criteria = event.target.value;
                getOrdersStatistics(order_search_criteria);
            });
        });

        let orders_step = [];
        let orders_completed = [];
        let orders_active = [];
        let orders_cancelled = [];
        let chart;

        async function getOrdersStatistics(order_search_criteria) {
            try {
                const url = `/dashboard/get-orders?search_criteria=${order_search_criteria}`;
                const response = await fetch(url, {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json' },
                });

                if (!response.ok) {
                    throw new Error(`Error: ${response.status} ${response.statusText}`);
                }

                const data = await response.json();

                if (data.length > 0) {
                    orders_step = [];
                    orders_completed = [];
                    orders_active = [];
                    orders_cancelled = [];

                    for (const item of data) {
                        orders_step.push(item.end_date);
                        orders_completed.push(item.completed);
                        orders_active.push(item.active);
                        orders_cancelled.push(item.cancelled);
                    }
                }
                updateChart();
            } catch (error) {
                console.error('Failed to fetch order statistics:', error.message);
            }
        }

        function updateChart() {
            if (chart) {
                chart.data.labels = orders_step;
                chart.data.datasets[0].data = orders_completed;
                chart.data.datasets[1].data = orders_active;
                chart.data.datasets[2].data = orders_cancelled;

                if (order_search_criteria == 'weekly') {
                    chart.options.scales.x.title.text = "{{ __('messages.dashboard.home.days') }}";
                } else if (order_search_criteria == 'monthly') {
                    chart.options.scales.x.title.text = "{{ __('messages.dashboard.home.weeks') }}";
                } else if (order_search_criteria == 'yearly') {
                    chart.options.scales.x.title.text = "{{ __('messages.dashboard.home.months') }}";
                }

                chart.update();
            }
        }

        const ctxDeliveredOrders = document.getElementById('graph_delivered_orders');
        chart = new Chart(ctxDeliveredOrders, {
            type: 'bar',
            data: {
                labels: orders_step,
                datasets: [
                    {
                        label: "{{ __('messages.dashboard.home.completed') }}",
                        data: orders_completed,
                        backgroundColor: '#6D28D9',
                        borderRadius: 4,
                    },
                    {
                        label: "{{ __('messages.dashboard.home.active') }}",
                        data: orders_active,
                        backgroundColor: '#A855F7',
                        borderRadius: 4,
                    },
                    {
                        label: "{{ __('messages.dashboard.home.cancelled') }}",
                        data: orders_cancelled,
                        backgroundColor: '#94A3B8',
                        borderRadius: 4,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "{{ __('messages.dashboard.home.days') }}",
                        },
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "{{ __('messages.dashboard.home.orders') }}",
                        },
                    },
                },
            },
        });

        getOrdersStatistics('weekly');

        let amount_search_criteria = 'weekly';

        document.querySelectorAll('input[name="search_period_amount"]').forEach((input) => {
            input.addEventListener('change', (event) => {
                amount_search_criteria = event.target.value;
                getOrdersAmountStatistics(amount_search_criteria);
            });
        });

        let net_amount_step = [];
        let net_amount_completed = [];
        let net_amount_active = [];
        let net_amount_cancelled = [];
        let chart_amount;

        async function getOrdersAmountStatistics(amount_search_criteria) {
            try {
                const url = `/dashboard/get-amount?search_criteria=${amount_search_criteria}`;
                const response = await fetch(url, {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json' },
                });

                if (!response.ok) {
                    throw new Error(`Error: ${response.status} ${response.statusText}`);
                }

                const data = await response.json();

                if (data.length > 0) {
                    net_amount_step = [];
                    net_amount_completed = [];
                    net_amount_active = [];
                    net_amount_cancelled = [];

                    for (const item of data) {
                        net_amount_step.push(item.end_date);
                        net_amount_completed.push(item.completed);
                        net_amount_active.push(item.active);
                        net_amount_cancelled.push(item.cancelled);
                    }
                }
                updateAmountChart();
            } catch (error) {
                console.error('Failed to fetch order statistics:', error.message);
            }
        }

        function updateAmountChart() {
            if (chart_amount) {
                chart_amount.data.labels = net_amount_step;
                chart_amount.data.datasets[0].data = net_amount_completed;
                chart_amount.data.datasets[1].data = net_amount_active;
                chart_amount.data.datasets[2].data = net_amount_cancelled;

                if (amount_search_criteria == 'weekly') {
                    chart_amount.options.scales.x.title.text = "{{ __('messages.dashboard.home.days') }}";
                } else if (amount_search_criteria == 'monthly') {
                    chart_amount.options.scales.x.title.text = "{{ __('messages.dashboard.home.weeks') }}";
                } else if (amount_search_criteria == 'yearly') {
                    chart_amount.options.scales.x.title.text = "{{ __('messages.dashboard.home.months') }}";
                }

                chart_amount.update();
            }
        }

        const ctxAmountOrders = document.getElementById('graph_amount_net_amount');
        chart_amount = new Chart(ctxAmountOrders, {
            type: 'line',
            data: {
                labels: net_amount_step,
                datasets: [
                    {
                        label: "{{ __('messages.dashboard.home.completed') }}",
                        data: net_amount_completed,
                        fill: true,
                        backgroundColor: 'rgba(109, 40, 217, 0.18)',
                        borderColor: '#6D28D9',
                        borderWidth: 2,
                        tension: 0.3,
                    },
                    {
                        label: "{{ __('messages.dashboard.home.active') }}",
                        data: net_amount_active,
                        fill: true,
                        backgroundColor: 'rgba(168, 85, 247, 0.14)',
                        borderColor: '#A855F7',
                        borderWidth: 2,
                        tension: 0.3,
                    },
                    {
                        label: "{{ __('messages.dashboard.home.cancelled') }}",
                        data: net_amount_cancelled,
                        fill: true,
                        backgroundColor: 'rgba(148, 163, 184, 0.15)',
                        borderColor: '#64748B',
                        borderWidth: 2,
                        tension: 0.3,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "{{ __('messages.dashboard.home.days') }}",
                        },
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "{{ __('messages.dashboard.home.amount') }}",
                        },
                    },
                },
            },
        });

        getOrdersAmountStatistics('weekly');

        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                showToast(["{{ session('success') }}"]);
            @endif

            @if (session('error'))
                showToast(["{{ session('error') }}"]);
            @endif

            const modal = document.getElementById("modal_status_component");
            if (modal) {
                const emailNotification = modal.querySelector("#email-notification");
                const titlePdfArchive = modal.querySelector('#file_title_modal');
                const pdfArchive = modal.querySelector('#pdf-archive');

                if (emailNotification) {
                    emailNotification.addEventListener('change', function () {
                        if (emailNotification.checked) {
                            titlePdfArchive.classList.remove('hidden');
                            pdfArchive.classList.remove('hidden');
                            pdfArchive.disabled = false;
                        } else {
                            titlePdfArchive.classList.add('hidden');
                            pdfArchive.classList.add('hidden');
                            pdfArchive.disabled = true;
                        }
                        if (pdfArchive) {
                            pdfArchive.value = '';
                        }
                    });
                }
            }
        });
    </script>
@endpush
