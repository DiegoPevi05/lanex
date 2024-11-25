@extends('layouts.client')


@section('content-client')
    <section id="suppliers_hero_section" class="w-full flex flex-col bg-slate-700 h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">
        <img src="{{ asset('storage/'. '/images/web/supplier.jpg') }}" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30 bg-transparent">
            <div class="w-full h-full flex flex-col-reverse xl:flex-row justify-center gap-y-12">

                <div class="w-full xl:w-full h-auto flex flex-col justify-end items-center gap-y-4 animation-element slide-in-up">
                    <div class="bg-transparent w-full xl:w-[350px] h-auto x:h-[500px] hover:-translate-y-[20px] duration-300">
                        @if(!empty($supplier['products']) && isset($supplier['products'][0]))
                            <x-product-card :product="$supplier['products'][0]"/>
                        @endif
                    </div>
                </div>
                <div class="w-full h-auto flex flex-col items-start justify-center text-body gap-y-1 xl:p-6 animation-element slide-in-up">
                    <img src={{ asset('storage/'. $supplier['logo'])}} class="w-[40%] h-auto"/>
                    <h5 class="font-bold text-white">{{$supplier['name']}}</h5>
                    <h1 class="font-bold text-white">{{ __('messages.supplier.hero.header') }}</h1>
                    <div class="w-full flex flex-col sm:flex-row items-end sm:items-center justify-start gap-y-4 sm:gap-x-4 p-4 rounded-xl" style="background-color: rgba(255, 255, 255, 0.6);">
                        <input placeholder="Buscar Producto por EAN" class="uppercase w-full border-2 border-body rounded-md p-4 text-md font-bold focus:border-2 focus:border-primary focus:outline-none" />
                        <x-button text="Buscar" url="#" extraClasses="h-full uppercase font-bold"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="supplier_products" class="w-full flex flex-col h-auto padding gap-y-12">
        <div class="w-full h-auto flex flex-col justify-start items-center">
            <h5 class="animation-element slide-in-up text-primary">
                {{ __('messages.supplier.products.header') }}

            </h5>
            <h1 class="text-primary-dark font-bold animation-element slide-in-up text-center">
                {{ __('messages.supplier.products.title') }}

            </h1>
        </div>
        <div class="h-full w-full grid grid-cols-3 sm:grid-cols-4 xl:grid-cols-3 gap-6 xl:gap-x-24 xl:gap-y-12 animation-group">
            @if(!empty($products) && isset($products[0]))
                @foreach ($products as $product)
                    <div class="col-span-1 row-span-1 flex flex-col justify-center items-start animation-element slide-in-right">
                        <div class="w-full xl:w-[350px] h-auto x:h-[500px] hover:-translate-y-[20px] duration-300">
                            <x-product-card :product="$product" />
                        </div>
                    </div>
                @endforeach

<div class="col-span-3 sm:col-span-4 xl:col-span-3 flex flex-row justify-around">
    <div class="flex flex-row w-auto h-auto justify-center items-center gap-x-4">
        <!-- First Page -->
        <a href="{{ route('supplier', ['id' => $supplier->id, 'page_products' => 1]) }}"
           class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white
           {{ Request::query('page_products', 1) == 1 ? 'bg-gray-300 pointer-events-none border-gray-200 text-gray-200' : ' text-white bg-primary hover:bg-white hover:text-primary border-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-left">
                <path d="m11 17-5-5 5-5"></path><path d="m18 17-5-5 5-5"></path>
            </svg>
        </a>
        <!-- Previous Page -->
        <a href="{{ route('supplier', ['id' => $supplier->id, 'page_products' => max(1, $products->currentPage() - 1)]) }}"
           class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white
           {{ Request::query('page_products', 1) == 1 ? 'bg-gray-300 pointer-events-none border-gray-200 text-gray-200' : ' text-white bg-primary hover:bg-white hover:text-primary border-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
        </a>
    </div>
    <div class="flex flex-row w-auto h-auto justify-center items-center gap-x-4">
        <!-- Next Page -->
        <a href="{{ route('supplier', ['id' => $supplier->id, 'page_products' => min($products->lastPage(), $products->currentPage() + 1)]) }}"
           class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white
           {{ $products->lastPage() == $products->currentPage()   ? 'bg-gray-300 pointer-events-none border-gray-200 text-gray-200' : ' text-white bg-primary hover:bg-white hover:text-primary border-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </a>
        <!-- Last Page -->
        <a href="{{ route('supplier', ['id' => $supplier->id, 'page_products' => $products->lastPage()]) }}"
           class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white
           {{ $products->lastPage() == $products->currentPage()   ? 'bg-gray-300 pointer-events-none border-gray-200 text-gray-200' : ' text-white bg-primary hover:bg-white hover:text-primary border-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-right">
                <path d="m6 17 5-5-5-5"></path><path d="m13 17 5-5-5-5"></path>
            </svg>
        </a>
    </div>
</div>
            @else
                <div class="col-span-1 sm:col-span-2 xl:col-span-3 flex flex-col items-center justify-center py-24 gap-y-12">
                    <h5 class="font-bold text-primary">{{ __('messages.common.no_products') }}</h5>
                    <img src="/images/svg/empty.svg" class="h-48 w-auto"/>
                </div>
            @endif
        </div>
    </section>
    <section id="suppliers-sections" class="relative w-full h-full padding flex flex-col justify-center items-center">
        <h5 class="animation-element slide-in-up">{{ __('messages.supplier.supplier_section.header') }}</h5>
        <h1 class="font-bold text-primary-dark animation-element slide-in-up text-center">
            {{ __('messages.supplier.supplier_section.title') }}
        </h1>

        <div class="w-full h-auto min-h-[400px] py-12 xl:p-12 flex flex-col justify-center items-center duration-300 transition-all">
            <div id="suppliers-items" class="h-full w-full grid grid-cols-3 sm:grid-cols-4 xl:grid-cols-3 gap-6 xl:gap-24 animation-element slide-in-down">

            </div>
            <div id="loader-suppliers-content" class="w-full h-auto flex justify-center items-center animate-spin text-primary hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 sm:h-20 w-10 sm:w-20 lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
            </div>
            <div id="empty-suppliers-content" class="w-full h-auto flex flex-col items-center justify-center gap-y-12 animation-element slide-in-down hidden">
                <h5 class="font-bold text-primary">{{__('messages.suppliers.supplier_section.empty_content')}}</h5>
                <img src="{{ asset('storage/' . '/images/web/empty.svg' ) }}" class="h-48 w-auto"/>
            </div>
        </div>

        <div class="w-full h-auto flex flex-row justify-around">
            <div class="flex flex-row w-auto h-auto justify-center items-center gap-x-4">
                <!-- First Page -->
                <button
                   id="first-suppliers-page"
                   class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white text-white bg-primary hover:bg-white hover:text-primary border-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-left">
                        <path d="m11 17-5-5 5-5"></path><path d="m18 17-5-5 5-5"></path>
                    </svg>
                </button>
                <!-- Previous Page -->
                <button
                   id="prev-suppliers-page"
                   class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white text-white bg-primary hover:bg-white hover:text-primary border-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </button>
            </div>
            <div class="flex flex-row w-auto h-auto justify-center items-center gap-x-4">
                <!-- Next Page -->
                <button
                   id="next-suppliers-page"
                   class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white text-white bg-primary hover:bg-white hover:text-primary border-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
                <!-- Last Page -->
                <button

                   id="last-suppliers-page"
                   class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white text-white bg-primary hover:bg-white hover:text-primary border-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-right">
                        <path d="m6 17 5-5-5-5"></path><path d="m13 17 5-5-5-5"></path>
                    </svg>
                </button>
            </div>
        </div>


    </section>
@endsection



@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const suppliersSections = document.getElementById('suppliers-sections');
        const suppliersContainer = document.getElementById('suppliers-items');
        const loaderSuppliersContent = document.getElementById('loader-suppliers-content');

        const firstSupplierPageBtn = document.getElementById('first-suppliers-page');
        const prevSupplierPageBtn = document.getElementById('prev-suppliers-page');
        const nextSupplierPageBtn = document.getElementById('next-suppliers-page');
        const lastSupplierPageBtn = document.getElementById('last-suppliers-page');

        const emptySuppliersContent = document.getElementById('empty-suppliers-content')

        let currentSupplierPage = 1;
        let lastSupplierPage = 1;
        // Function to fetch and render suppliers
        async function fetchSuppliers(page = 1, supplierName = '') {
            suppliersContainer.classList.add('hidden');
            loaderSuppliersContent.classList.remove('hidden');
            emptySuppliersContent.classList.add('hidden');

            try {
                // Fetch data from the API
                const response = await fetch(`/suppliers/api?page_suppliers=${page}&supplier_name=${supplierName}`);
                const data = await response.json();

                // Clear existing suppliers
                suppliersContainer.innerHTML = '';

                if (data.suppliers.data.length === 0) {
                    emptySuppliersContent.classList.remove('hidden');
                    loaderSuppliersContent.classList.add('hidden');
                    return;
                }

                // Populate suppliers
                data.suppliers.data.forEach(supplier => {
                    const supplierDiv = document.createElement('div');
                    supplierDiv.classList.add('col-span-3', 'sm:col-span-2', 'xl:col-span-1', 'flex', 'flex-col', 'justify-start', 'items-start', 'h-auto');

                    supplierDiv.innerHTML = `
                        <div class="w-full min-h-[200px] flex justify-center items-center p-4">
                            <img src="/storage/${supplier.logo}" class="w-auto h-16" alt="${supplier.name}">
                        </div>
                        <a href="/supplier/${supplier.id}" class="group p-none m-none">
                            <span class="font-bold text-primary group-hover:underline">${supplier.name}</span>
                        </a>
                        <div class="w-full h-full p-6">
                            <ul class="list-disc">
                                ${supplier.details.map(detail => `<li><p>${detail}</p></li>`).join('')}
                            </ul>
                        </div>
                    `;

                    suppliersContainer.appendChild(supplierDiv);
                });

                // Update pagination
                currentSupplierPage = data.suppliers.current_page;
                lastSupplierPage = data.suppliers.last_page;

                toggleDisableButton(firstSupplierPageBtn,currentSupplierPage === 1);
                toggleDisableButton(prevSupplierPageBtn,currentSupplierPage === 1);
                toggleDisableButton(nextSupplierPageBtn,currentSupplierPage === data.suppliers.last_page);
                toggleDisableButton(lastSupplierPageBtn,currentSupplierPage === data.suppliers.last_page);

                suppliersContainer.classList.remove('hidden');
                loaderSuppliersContent.classList.add('hidden');
            } catch (error) {
                console.error('Error fetching suppliers:', error);
                emptySuppliersContent.classList.remove('hidden');
            }

        }

        function toggleDisableButton(button,disable){
            if(disable){
                button.classList.add('bg-gray-300','pointer-events-none','border-gray-200','text-gray-200')
                button.classList.remove('text-white','bg-primary','hover:bg-white','hover:text-primary','border-primary')
            }else{
                button.classList.remove('bg-gray-300','pointer-events-none','border-gray-200','text-gray-200')
                button.classList.add('text-white','bg-primary','hover:bg-white','hover:text-primary','border-primary')
            }
        }

        function scrollToSuppliersSections() {
            suppliersSections.scrollIntoView({ behavior: 'smooth' });
        }

        firstSupplierPageBtn.addEventListener('click',()=> {
            fetchSuppliers(1);
            scrollToSuppliersSections();
        })
        // Event listeners for pagination
        prevSupplierPageBtn.addEventListener('click', () => {
            if (currentSupplierPage > 1) {
                fetchSuppliers(currentSupplierPage - 1);
            }
            scrollToSuppliersSections();
        });

        nextSupplierPageBtn.addEventListener('click', () => {
            fetchSuppliers(currentSupplierPage + 1);
            scrollToSuppliersSections();
        });

        lastSupplierPageBtn.addEventListener('click',()=>{
            fetchSuppliers(lastSupplierPage);
            scrollToSuppliersSections();
        });


        // Initial load
        fetchSuppliers();
    });
</script>
@endpush
