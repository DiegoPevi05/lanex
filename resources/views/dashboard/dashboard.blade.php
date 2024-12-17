@extends('layouts.dashboard')

@section('content-dashboard')
    <section id="dashboard_home" class="bg-gray-light h-full w-full flex flex-row xl:gap-x-4 p-4 max-lg:overflow-y-scroll">

        <div class="w-full h-full max-lg:flex max-lg:flex-col max-lg:justify-start max-lg:items-start lg:grid lg:grid-cols-2 lg:grid-rows-2 bg-gray-light rounded-xl gap-4">

            <div class="max-lg:w-full max-lg:h-auto lg:col-span-1 lg:row-span-2 flex flex-col justify-stat items-start bg-white rounded-xl p-4">
                <div class="w-full h-auto flex flex-row justify-between py-4">
                    <div class="w-auto h-auto flex flex-row items-center gap-x-2">
                        <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        </span>
                        <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.home.active_orders') }}</h4>
                    </div>
                </div>

                <div id="order-cards-container" class="w-full h-full flex flex-col justify-start items-start overflow-y-scroll gap-y-4">

                    @foreach ($pagination->items() as $paginate)
                        <x-order-card :data="$paginate" type="dashboard"/>
                    @endforeach
                </div>

                <div class="w-full h-auto flex flex-row justify-between mt-auto">
                    <div class="w-auto flex flex-row gap-x-1">
                        <a href="{{route('dashboard_home',['page' => 1 ] )}}" class="{{$pagination->currentPage() == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center   duration-300 cursor-pointer  p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                        </a>

                        <a href="{{ route('dashboard_home', ['page' =>$pagination->currentPage() - 1]) }}" class="{{$pagination->currentPage() == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m15 18-6-6 6-6"/></svg>
                        </a>
                    </div>

                    <div class="w-auto flex flex-row gap-x-1">
                        <a href="{{ route('dashboard_home', ['page' =>$pagination->currentPage() + 1]) }}" class="{{$pagination->lastPage() == $pagination->currentPage() ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full"><path d="m9 18 6-6-6-6"/></svg>
                        </a>

                        <a href="{{ route('dashboard_home', ['page' =>$pagination->lastPage()]) }}" class="{{$pagination->lastPage() == $pagination->currentPage() ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                        </a>
                    </div>
                </div>

            </div>

            <div class="max-lg:w-full max-lg:h-auto lg:col-span-1 lg:row-span-1 flex flex-col justify-stat items-start bg-white rounded-xl p-4">
                <div class="w-full h-auto flex flex-row justify-between py-4">
                    <div class="w-auto h-auto flex flex-row items-center gap-x-2">
                        <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        </span>
                        <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.home.delivered_orders') }}</h4>
                    </div>

                    <div class="w-auto h-auto flex flex-row items-center justify-end gap-x-2">
                        <!-- Weekly -->
                        <label class="flex items-center gap-x-2 cursor-pointer">
                            <input type="radio" name="search_period_orders" value="weekly" class="hidden peer" checked/>
                            <span class="peer-checked:bg-primary peer-checked:text-white p-2 rounded-xl text-xs bg-gray-light text-body duration-300 ">
                                {{ __('messages.dashboard.home.weekly') }}
                            </span>
                        </label>

                        <!-- Monthly -->
                        <label class="flex items-center gap-x-2 cursor-pointer">
                            <input type="radio" name="search_period_orders" value="monthly" class="hidden peer" />
                            <span class="peer-checked:bg-primary peer-checked:text-white p-2 rounded-xl text-xs bg-gray-light text-body duration-300 ">
                                {{ __('messages.dashboard.home.months') }}
                            </span>
                        </label>

                        <!-- Yearly -->
                        <label class="flex items-center gap-x-2 cursor-pointer">
                            <input type="radio" name="search_period_orders" value="yearly" class="hidden peer" />
                            <span class="peer-checked:bg-primary peer-checked:text-white p-2 rounded-xl text-xs bg-gray-light text-body duration-300 ">
                                {{ __('messages.dashboard.home.years') }}
                            </span>
                        </label>
                    </div>

                </div>
                <canvas id="graph_delivered_orders" class="w-full h-full">

                </canvas>
            </div>





            <div class="max-lg:w-full max-lg:h-auto lg:col-span-1 lg:row-span-1 flex flex-col justify-stat items-start bg-white rounded-xl p-4">
                <div class="w-full h-auto flex flex-row justify-between py-4">
                    <div class="w-auto h-auto flex flex-row items-center gap-x-2">
                        <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        </span>
                        <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.home.net_amount') }}</h4>
                    </div>

                    <div class="w-auto h-auto flex flex-row items-center justify-end gap-x-2">
                        <!-- Weekly -->
                        <label class="flex items-center gap-x-2 cursor-pointer">
                            <input type="radio" name="search_period_amount" value="weekly" class="hidden peer" checked/>
                            <span class="peer-checked:bg-primary peer-checked:text-white p-2 rounded-xl text-xs bg-gray-light text-body duration-300 ">
                                {{ __('messages.dashboard.home.weekly') }}
                            </span>
                        </label>

                        <!-- Monthly -->
                        <label class="flex items-center gap-x-2 cursor-pointer">
                            <input type="radio" name="search_period_amount" value="monthly" class="hidden peer" />
                            <span class="peer-checked:bg-primary peer-checked:text-white p-2 rounded-xl text-xs bg-gray-light text-body duration-300 ">
                                {{ __('messages.dashboard.home.months') }}
                            </span>
                        </label>

                        <!-- Yearly -->
                        <label class="flex items-center gap-x-2 cursor-pointer">
                            <input type="radio" name="search_period_amount" value="yearly" class="hidden peer" />
                            <span class="peer-checked:bg-primary peer-checked:text-white p-2 rounded-xl text-xs bg-gray-light text-body duration-300 ">
                                {{ __('messages.dashboard.home.years') }}
                            </span>
                        </label>
                    </div>
                </div>
                <canvas id="graph_amount_net_amount" class="w-full h-full">

                </canvas>

            </div>

        </div>

    </section>
    <x-order-status-modal/>
    <x-order-custom-email-modal/>
@endsection

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        // Define the variable
        let order_search_criteria = 'weekly'; // Set default value to "weekly"

        // Add an event listener for change
        document.querySelectorAll('input[name="search_period_orders"]').forEach((input) => {
            input.addEventListener('change', (event) => {
                // Update the variable when the value changes
                order_search_criteria = event.target.value;
                getOrdersStatistics(order_search_criteria)
            });
        });

        let orders_step = [];
        let orders_completed = [];
        let orders_active = [];
        let orders_cancelled = [];
        // Global variable for the chart
        let chart;

        async function getOrdersStatistics(order_search_criteria) {
            try {
                // Construct the URL with the search criteria
                const url = `/dashboard/get-orders?search_criteria=${order_search_criteria}`;

                // Make the GET request to the server
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });

                // Check if the response is successful
                if (!response.ok) {
                    throw new Error(`Error: ${response.status} ${response.statusText}`);
                }

                // Parse the JSON response
                const data = await response.json();

                const currentLanguage = "{{ app()->getLocale() }}" === 'en' ? 'en-US' : 'es-ES';

                if(data.length > 0){
                    orders_step = [];
                    orders_completed = [];
                    orders_active = [];
                    orders_cancelled = [];

                    for(const item of data){
                        orders_step.push(item.end_date);
                        orders_completed.push(item.completed);
                        orders_active.push(item.active);
                        orders_cancelled.push(item.cancelled);
                    }

                }
                // After fetching the data, update the chart
                updateChart();

            } catch (error) {
                // Handle errors
                console.error('Failed to fetch order statistics:', error.message);
            }
        }

        // Function to update the chart
        function updateChart() {
            if (chart) {
                // Update the chart data
                chart.data.labels = orders_step;
                chart.data.datasets[0].data = orders_completed;
                chart.data.datasets[1].data = orders_active;
                chart.data.datasets[2].data = orders_cancelled;

                if(order_search_criteria == 'weekly'){
                    // Update the x-axis title
                    chart.options.scales.x.title.text = "{{ __('messages.dashboard.home.days') }}";
                }else if(order_search_criteria == 'monthly'){
                    chart.options.scales.x.title.text = "{{ __('messages.dashboard.home.weeks') }}";
                }else if(order_search_criteria == 'yearly'){
                    chart.options.scales.x.title.text = "{{ __('messages.dashboard.home.months') }}";
                }

                // Re-render the chart with the new data
                chart.update();
            }
        }


        // Bar Chart: Delivered Orders
        const ctxDeliveredOrders = document.getElementById('graph_delivered_orders');
        chart = new Chart(ctxDeliveredOrders, {
            type: 'bar',
            data: {
                labels: orders_step, // Months
                datasets: [

                    {
                        label: "{{ __('messages.dashboard.home.completed') }}",
                        data: orders_completed, // Fake data
                        backgroundColor: '#A55AD9',
                    },
                    {
                        label: "{{ __('messages.dashboard.home.active') }}",
                        data: orders_active, // Fake data
                        backgroundColor: '#B891D6',
                    },
                    {
                        label: "{{ __('messages.dashboard.home.cancelled') }}",
                        data: orders_cancelled, // Fake data
                        backgroundColor: '#5C6C7B',
                    },
                ],
            },
            options: {
                responsive: true,
                layout: {
                    padding: {
                        bottom: 40, // Add bottom padding in pixels
                    },
                },
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


        // Define the variable
        let amount_search_criteria = 'weekly'; // Set default value to "weekly"

        // Add an event listener for change
        document.querySelectorAll('input[name="search_period_amount"]').forEach((input) => {
            input.addEventListener('change', (event) => {
                // Update the variable when the value changes
                amount_search_criteria = event.target.value;
                getOrdersAmountStatistics(amount_search_criteria)
            });
        });

        let net_amount_step = [];
        let net_amount_completed = [];
        let net_amount_active = [];
        let net_amount_cancelled = [];
        // Global variable for the chart
        let chart_amount;

        async function getOrdersAmountStatistics(amount_search_criteria) {
            try {
                // Construct the URL with the search criteria
                const url = `/dashboard/get-amount?search_criteria=${amount_search_criteria}`;

                // Make the GET request to the server
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });

                // Check if the response is successful
                if (!response.ok) {
                    throw new Error(`Error: ${response.status} ${response.statusText}`);
                }

                // Parse the JSON response
                const data = await response.json();
                const currentLanguage = "{{ app()->getLocale() }}" === 'en' ? 'en-US' : 'es-ES';

                if(data.length > 0){
                    net_amount_step = [];
                    net_amount_completed = [];
                    net_amount_active = [];
                    net_amount_cancelled = [];

                    for(const item of data){
                        net_amount_step.push(item.end_date);
                        net_amount_completed.push(item.completed);
                        net_amount_active.push(item.active);
                        net_amount_cancelled.push(item.cancelled);
                    }

                }
                // After fetching the data, update the chart
                updateAmountChart();

            } catch (error) {
                // Handle errors
                console.error('Failed to fetch order statistics:', error.message);
            }
        }

        // Function to update the chart
        function updateAmountChart() {
            if (chart_amount) {
                // Update the chart data
                chart_amount.data.labels = net_amount_step;
                chart_amount.data.datasets[0].data = net_amount_completed;
                chart_amount.data.datasets[1].data = net_amount_active;
                chart_amount.data.datasets[2].data = net_amount_cancelled;

                if(amount_search_criteria == 'weekly'){
                    // Update the x-axis title
                    chart.options.scales.x.title.text = "{{ __('messages.dashboard.home.days') }}";
                }else if(amount_search_criteria == 'monthly'){
                    chart.options.scales.x.title.text = "{{ __('messages.dashboard.home.weeks') }}";
                }else if(amount_search_criteria == 'yearly'){
                    chart.options.scales.x.title.text = "{{ __('messages.dashboard.home.months') }}";
                }

                // Re-render the chart with the new data
                chart_amount.update();
            }
        }

        // Area Line Chart: Amount Gained
        const ctxAmountOrders = document.getElementById('graph_amount_net_amount');
        chart_amount = new Chart(ctxAmountOrders, {
            type: 'line',
            data: {
                labels: net_amount_step, // Months
                datasets: [
                    {
                        label: "{{ __('messages.dashboard.home.completed') }}",
                        data: orders_completed, // Fake data
                        fill: true, // Enable fill under the line
                        backgroundColor: 'rgba(165, 90, 217, 0.4)', // Semi-transparent fill
                        borderColor: 'rgba(165, 90, 217, 1)', // Solid line
                        borderWidth: 2, // Optional: Adjust the line thickness
                    },
                    {
                        label: "{{ __('messages.dashboard.home.active') }}",
                        data: orders_active, // Fake data
                        fill: true, // Enable fill under the line
                        backgroundColor: 'rgba(184, 145, 214, 0.4)', // Semi-transparent fill
                        borderColor: 'rgba(184, 145, 214, 1)', // Solid line
                        borderWidth: 2, // Optional: Adjust the line thickness
                    },
                    {
                        label: "{{ __('messages.dashboard.home.cancelled') }}",
                        data: orders_cancelled, // Fake data
                        fill: true, // Enable fill under the line
                        backgroundColor: 'rgba(92, 108, 123, 0.4)', // Semi-transparent fill
                        borderColor: 'rgba(92, 108, 123, 1)', // Solid line
                        borderWidth: 2, // Optional: Adjust the line thickness
                    },
                ],
            },
            options: {
                responsive: true,
                layout: {
                    padding: {
                        bottom: 40, // Add bottom padding in pixels
                    },
                },
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
                        // Clear the file input value
                        if (pdfArchive) {
                            pdfArchive.value = '';
                        }
                    });
                }
            }
        });
    </script>
@endpush
