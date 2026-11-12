@section('title', 'Red Global de Proveedores y Aliados | LanEx')
@section('meta_description', __('messages.meta.suppliers'))
@extends('layouts.client')


@section('content-client')
    <section id="suppliers_hero_section" data-enter class="w-full flex flex-col min-h-[75svh] lg:min-h-[82svh] pt-[160px] xl:pt-[190px] pb-24 relative z-10 text-white overflow-hidden bg-slate-950">
        <!-- Photographic Ground with High Visibility -->
        <img src="{{ asset('storage/images/web/localization.webp') }}" alt="{{ __('Proveedores Internacionales LanEx') }}" class="hero-enter-media w-full h-full absolute inset-0 object-cover opacity-55">
        <!-- Protective Dark Gradient Overlays for Guaranteed Text Legibility -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-primary-dark/45 z-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary/35 via-transparent to-transparent z-10 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-6 lg:px-8 relative z-20 w-full my-auto flex flex-col justify-center items-center text-center">
            <span class="hero-enter-item text-xs sm:text-sm font-bold uppercase tracking-widest text-purple-400 block mb-3">
                {{ __('RED DE PROVEEDORES VERIFICADOS') }}
            </span>
            <h1 class="hero-enter-item text-3xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight sm:leading-none font-display mb-4">
                {{ __('messages.suppliers.supplier_section.title') }}
            </h1>
            <p class="hero-enter-item text-base sm:text-lg text-slate-300 font-normal leading-relaxed max-w-2xl mb-8">
                {{ __('Encuentra fabricantes directos y distribuidores certificados en China, Estados Unidos y la región con logística y flete asegurado.') }}
            </p>

            <div class="hero-enter-item w-full max-w-2xl bg-white p-2 sm:p-2.5 rounded-2xl shadow-xl border border-slate-200 text-left">
                <label for="supplierNameInput" class="sr-only">{{ __('Buscar proveedor por nombre o categoría') }}</label>
                <div class="w-full flex flex-col sm:flex-row items-center gap-2">
                    <div class="relative w-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400 absolute left-3.5 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <input
                            id="supplierNameInput"
                            placeholder="{{ __('messages.suppliers.hero.input_placeholder') }}"
                            class="w-full pl-11 pr-4 h-11 rounded-xl border border-slate-200 text-slate-900 text-base font-medium focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                        />
                    </div>
                    <button
                        id="searchButton"
                        class="taste-btn w-full sm:w-auto px-6 h-11 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm shrink-0 cursor-pointer"
                    >
                        {{ __('messages.suppliers.hero.input_button') }}
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section id="suppliers-sections" class="relative w-full h-auto py-16 sm:py-24 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col">
            <div class="max-w-2xl mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-2">{{ __('messages.suppliers.supplier_section.header') }}</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight font-display">
                    {{ __('messages.suppliers.supplier_section.title') }}
                </h2>
            </div>

            <div class="w-full h-auto min-h-[380px] pb-10 flex flex-col justify-center items-center">
                <div id="suppliers-items" class="h-full w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                </div>
                <div id="loader-suppliers-content" class="w-full h-auto flex justify-center items-center animate-spin text-primary hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-12 w-12 lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </div>
                <div id="empty-suppliers-content" class="w-full h-auto flex flex-col items-center justify-center gap-y-6 hidden">
                    <p class="font-bold text-slate-700 text-lg">{{__('messages.suppliers.supplier_section.empty_content')}}</p>
                    <img src="{{ asset('storage/' . '/images/web/empty.svg' ) }}" alt="{{ __('Sin resultados') }}" class="h-28 w-auto"/>
                </div>
            </div>

            <div class="w-full flex flex-row justify-between items-center pt-6 border-t border-slate-200/80">
                <div class="flex flex-row items-center gap-x-3">
                    <!-- First Page -->
                    <button
                       id="first-suppliers-page"
                       aria-label="{{ __('Primera página de proveedores') }}"
                       class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m11 17-5-5 5-5"></path><path d="m18 17-5-5 5-5"></path>
                        </svg>
                    </button>
                    <!-- Previous Page -->
                    <button
                       id="prev-suppliers-page"
                       aria-label="{{ __('Página anterior de proveedores') }}"
                       class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-row items-center gap-x-3">
                    <!-- Next Page -->
                    <button
                       id="next-suppliers-page"
                       aria-label="{{ __('Página siguiente de proveedores') }}"
                       class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </button>
                    <!-- Last Page -->
                    <button
                       id="last-suppliers-page"
                       aria-label="{{ __('Última página de proveedores') }}"
                       class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 17 5-5-5-5"></path><path d="m13 17 5-5-5-5"></path>
                        </svg>
                    </button>
                </div>
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
                    const supplierCard = document.createElement('a');
                    supplierCard.href = `/supplier/${supplier.id}`;
                    supplierCard.classList.add(
                        'taste-card-link', 'group', 'bg-white', 'border', 'border-slate-200/90', 'hover:border-primary/50',
                        'rounded-2xl', 'p-6', 'flex', 'flex-col', 'justify-between', 'gap-5', 'hover:shadow-md'
                    );

                    const detailsHtml = (supplier.details && Array.isArray(supplier.details))
                        ? supplier.details.map(detail => `<li class="text-sm text-slate-600 leading-relaxed flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-primary mt-2 shrink-0"></span><span>${detail}</span></li>`).join('')
                        : '';

                    supplierCard.innerHTML = `
                        <div class="flex flex-col gap-4">
                            <div class="w-full h-24 rounded-xl bg-slate-50 border border-slate-100 flex justify-center items-center p-4 overflow-hidden">
                                <img src="/storage/${supplier.logo}" alt="${supplier.name}" class="taste-photo-zoom max-h-12 w-auto max-w-[160px] object-contain">
                            </div>
                            <h3 class="font-bold text-lg text-slate-900 group-hover:text-primary transition-colors">${supplier.name}</h3>
                            <ul class="flex flex-col gap-2">
                                ${detailsHtml}
                            </ul>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-primary">
                            <span>Ver catálogo del proveedor</span>
                            <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    `;

                    suppliersContainer.appendChild(supplierCard);
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
                handleSupplierSearch();
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
