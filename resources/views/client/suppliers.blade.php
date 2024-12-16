@section('meta_description', __('messages.meta.suppliers'))
@extends('layouts.client')


@section('content-client')
    <section id="suppliers_hero_section" class="w-full flex flex-col h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">

        <img src="{{ asset('storage/'.'images/web/localization.webp')}}" alt="suppliers_hero_image" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center gap-y-12 animation-group">

                <div class="w-full h-auto flex flex-col justify-center items-center gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2 justify-center items-start lg:items-center">
                        <h5 class="font-bold text-left lg:text-center">{{ __('messages.suppliers.hero.header') }}</h5>
                        <h1 class="font-bold text-left lg:text-center">{{ __('messages.suppliers.hero.title') }}</h1>
                    </div>
                </div>
                <div class="w-full h-auto flex flex-col items-start justify-start text-body gap-y-1 bg-primary-dark sm:bg-white p-3 sm:p-6 rounded-xl animation-element slide-in-up" >
                    <div class="w-full flex flex-col sm:flex-row items-end sm:items-center justify-start gap-y-4 sm:gap-x-4">
                        <input
                            id="supplierNameInput"
                            placeholder="{{ __('messages.suppliers.hero.input_placeholder') }}" class="uppercase w-full border-2 border-body rounded-md p-4 text-md font-bold focus:border-2 focus:border-primary focus:outline-none" />
                        <button
                        id="searchButton"
                        class="h-full uppercase font-bold rounded-xl active:scale-95 duration-300 hover:bg-primary-dark bg-primary text-white p-4 rounded-md">
                        {{ __('messages.suppliers.hero.input_button') }}
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="suppliers-sections" class="relative w-full h-full padding flex flex-col justify-center items-center">
        <h5 class="animation-element slide-in-up text-primary">{{ __('messages.suppliers.supplier_section.header') }}</h5>
        <h1 class="font-bold text-primary-dark animation-element slide-in-up text-center">
            {{ __('messages.suppliers.supplier_section.title') }}
        </h1>

        <div class="w-full h-auto min-h-[400px] py-12 xl:p-12 flex flex-col justify-center items-center duration-300 transition-all">
            <div id="suppliers-items" class="h-full w-full grid grid-cols-3 sm:grid-cols-4 xl:grid-cols-3 gap-6 xl:gap-24 animation-element slide-in-down">

            </div>
            <div id="loader-suppliers-content" class="w-full h-auto flex justify-center items-center animate-spin text-primary hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 sm:h-20 w-10 sm:w-20 lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
            </div>
            <div id="empty-suppliers-content" class="w-full h-auto flex flex-col items-center justify-center gap-y-12 animation-element slide-in-down hidden">
                <h5 class="font-bold text-primary">{{__('messages.suppliers.supplier_section.empty_content')}}</h5>
                <img src="{{ asset('storage/' . '/images/web/empty.svg' ) }}" class="h-24 sm:h-48 w-auto"/>
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
        const searchSupplierBtn = document.getElementById('searchButton');
        const searchSupplierInput = document.getElementById('supplierNameInput');

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

                // Update pagination buttons
                currentSupplierPage = data.suppliers.current_page;
                lastSupplierPage = data.suppliers.last_page;

                toggleDisableButton(firstSupplierPageBtn,currentSupplierPage === 1);
                toggleDisableButton(prevSupplierPageBtn,currentSupplierPage === 1);
                toggleDisableButton(nextSupplierPageBtn,currentSupplierPage === data.suppliers.last_page);
                toggleDisableButton(lastSupplierPageBtn,currentSupplierPage === data.suppliers.last_page);

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
                            <img src="/storage/${supplier.logo}" alt="supplier_logo_image" class="w-auto h-16" alt="${supplier.name}">
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

        function handleSupplierSearch(){
            if(searchSupplierInput.value && searchSupplierInput.value.length != 0){
                fetchSuppliers(1,searchSupplierInput.value);
                scrollToSuppliersSections();
            }else{
                fetchSuppliers(1);
                scrollToSuppliersSections();
            }
        }

        searchSupplierBtn.addEventListener('click', handleSupplierSearch);

        searchSupplierInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                handleProductSearch();
            }
        });

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
