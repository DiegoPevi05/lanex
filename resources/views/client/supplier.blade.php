@section('title', ($supplier->name ?? 'Proveedor') . ' — Catálogo y Productos | LanEx')
@section('meta_description', !empty($supplier->description) ? Str::limit(strip_tags($supplier->description), 155) : __('messages.meta.supplier'))
@if(!empty($supplier->image))
@section('og_image', asset('storage/' . $supplier->image))
@endif
@extends('layouts.client')


@section('content-client')
    <section id="suppliers_hero_section" data-enter class="w-full flex flex-col min-h-[75svh] lg:min-h-[82svh] pt-[160px] xl:pt-[190px] pb-24 relative z-10 text-white overflow-hidden bg-slate-950">
        <img src="{{ asset('storage/images/web/supplier.webp') }}" alt="{{ __('Proveedor LanEx') }}" class="hero-enter-media w-full h-full absolute inset-0 object-cover opacity-55">
        <!-- Protective Dark Gradient Overlays for Guaranteed Text Legibility -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-primary-dark/45 z-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary/35 via-transparent to-transparent z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-20 w-full my-auto flex flex-col justify-center">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 flex flex-col items-start gap-4">
                    <div class="hero-enter-item flex items-center gap-3 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/20">
                        <img src="{{ asset('storage/'. $supplier['logo']) }}" alt="{{ $supplier['name'] }}" class="h-6 w-auto object-contain brightness-110"/>
                        <span class="text-xs font-bold text-white uppercase tracking-wider">{{ $supplier['name'] }}</span>
                    </div>

                    <h1 class="hero-enter-item text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight font-display">
                        {{ __('messages.supplier.hero.header') }}
                    </h1>

                    <div class="hero-enter-item w-full max-w-xl bg-white p-2 rounded-2xl shadow-xl border border-slate-200 mt-2">
                        <label for="search_product_input" class="sr-only">{{ __('Buscar producto de este proveedor') }}</label>
                        <div class="w-full flex flex-col sm:flex-row items-center gap-2">
                            <input id="search_product_input" placeholder="{{__('messages.supplier.supplier_section.search_input_placeholder')}}" class="w-full px-4 h-11 rounded-xl border border-slate-200 text-slate-900 text-base font-medium focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none" />
                            <button id="search_product_btn" class="taste-btn w-full sm:w-auto px-6 h-11 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm shrink-0 cursor-pointer">
                                {{__('messages.supplier.supplier_section.search_button_label')}}
                            </button>
                        </div>
                    </div>

                    <div class="hero-enter-item flex flex-wrap items-center gap-3 mt-1">
                        <a href="{{ route('quote', ['type' => 'supplier', 'id' => $supplier['id']]) }}" class="taste-btn inline-flex items-center gap-2 h-11 px-5 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-xs uppercase tracking-wider shadow-lg shadow-primary/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/></svg>
                            <span>Cotizar Flete con {{ $supplier['name'] }}</span>
                        </a>
                        @if(!empty($supplier['webpage']))
                            <a href="{{ $supplier['webpage'] }}" target="_blank" rel="noopener noreferrer" class="taste-btn inline-flex items-center gap-2 h-11 px-4 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs border border-white/20">
                                <span>Sitio Oficial</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                @if(!empty($supplier['products']) && isset($supplier['products'][0]))
                    <div class="lg:col-span-4 flex justify-center hero-enter-item">
                        <div class="w-full max-w-[320px]">
                            <x-product-card :product="$supplier['products'][0]"/>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="products-sections" class="relative w-full h-auto py-16 sm:py-24 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col">
            <div class="max-w-2xl mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-2">{{ __('messages.supplier.products.header') }}</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight font-display">
                    {{ __('messages.supplier.products.title') }}
                </h2>
            </div>

            <div class="w-full h-auto min-h-[380px] pb-10 flex flex-col justify-center items-center">
                <div id="products-items" class="h-full w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                </div>
                <div id="loader-products-content" class="w-full h-auto flex justify-center items-center animate-spin text-primary hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-12 w-12 lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </div>
                <div id="empty-products-content" class="w-full h-auto flex flex-col items-center justify-center gap-y-6 hidden">
                    <p class="font-bold text-slate-700 text-lg">{{ __('messages.common.no_products') }}</p>
                    <img src="{{ asset('/images/svg/empty.svg' ) }}" alt="{{ __('Sin productos') }}" class="h-28 w-auto"/>
                </div>
            </div>

            <div class="w-full flex flex-row justify-between items-center pt-6 border-t border-slate-200/80">
                <div class="flex flex-row items-center gap-x-3">
                    <button id="first-products-page" aria-label="{{ __('Primera página de productos') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17-5-5 5-5"></path><path d="m18 17-5-5 5-5"></path></svg>
                    </button>
                    <button id="prev-products-page" aria-label="{{ __('Página anterior de productos') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg>
                    </button>
                </div>
                <div class="flex flex-row items-center gap-x-3">
                    <button id="next-products-page" aria-label="{{ __('Página siguiente de productos') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"></path></svg>
                    </button>
                    <button id="last-products-page" aria-label="{{ __('Última página de productos') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 17 5-5-5-5"></path><path d="m13 17 5-5-5-5"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section id="suppliers-sections" class="relative w-full h-auto py-16 sm:py-24 bg-slate-50 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col">
            <div class="max-w-2xl mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-2">{{ __('messages.supplier.supplier_section.header') }}</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight font-display">
                    {{ __('messages.supplier.supplier_section.title') }}
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
                    <img src="{{ asset('storage/' . '/images/web/empty.svg' ) }}" alt="{{ __('Sin proveedores') }}" class="h-28 w-auto"/>
                </div>
            </div>

            <div class="w-full flex flex-row justify-between items-center pt-6 border-t border-slate-200/80">
                <div class="flex flex-row items-center gap-x-3">
                    <button id="first-suppliers-page" aria-label="{{ __('Primera página de proveedores') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17-5-5 5-5"></path><path d="m18 17-5-5 5-5"></path></svg>
                    </button>
                    <button id="prev-suppliers-page" aria-label="{{ __('Página anterior de proveedores') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg>
                    </button>
                </div>
                <div class="flex flex-row items-center gap-x-3">
                    <button id="next-suppliers-page" aria-label="{{ __('Página siguiente de proveedores') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"></path></svg>
                    </button>
                    <button id="last-suppliers-page" aria-label="{{ __('Última página de proveedores') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 17 5-5-5-5"></path><path d="m13 17 5-5-5-5"></path></svg>
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

        //Products

        const productsSections = document.getElementById('products-sections');
        const productsContainer = document.getElementById('products-items');
        const loaderProductsContent = document.getElementById('loader-products-content');

        const firstProductPageBtn = document.getElementById('first-products-page');
        const prevProductPageBtn = document.getElementById('prev-products-page');
        const nextProductPageBtn = document.getElementById('next-products-page');
        const lastProductPageBtn = document.getElementById('last-products-page');

        const searchProductInput = document.getElementById('search_product_input');
        const searchProductBtn = document.getElementById('search_product_btn');


        const emptyProductsContent = document.getElementById('empty-products-content')

        let currentProductPage = 1;
        let lastProductPage = 1;
        // Function to fetch and render products
        async function fetchProducts(page = 1, productEan = '') {
            productsContainer.classList.add('hidden');
            loaderProductsContent.classList.remove('hidden');
            emptyProductsContent.classList.add('hidden');

            try {
                // Fetch data from the API
                const response = await fetch(`/supplier/products/api/{{$supplier['id']}}?page=${page}&product_name=${productEan}`);
                const data = await response.json();

                // Clear existing products
                productsContainer.innerHTML = '';

                // Update pagination buttons
                currentProductPage = data.products.current_page;
                lastProductPage = data.products.last_page;

                toggleDisableButton(firstProductPageBtn,currentProductPage === 1);
                toggleDisableButton(prevProductPageBtn,currentProductPage === 1);
                toggleDisableButton(nextProductPageBtn,currentProductPage === data.products.last_page);
                toggleDisableButton(lastProductPageBtn,currentProductPage === data.products.last_page);



                if (data.products.data.length === 0) {
                    emptyProductsContent.classList.remove('hidden');
                    loaderProductsContent.classList.add('hidden');
                    return;
                }

                // Populate products
                data.products.data.forEach(product => {
                    const productCard = document.createElement('div');
                    productCard.id = `product_card_${product.id}`;
                    productCard.classList.add(
                        'taste-card-link', 'group', 'w-full', 'h-full', 'bg-white', 'rounded-2xl', 'border', 'border-slate-200/90',
                        'hover:border-primary/50', 'hover:shadow-md', 'flex', 'flex-col', 'justify-between', 'p-6', 'text-slate-900'
                    );

                    const starsCount = parseInt(product.stars) || 5;
                    const description = product.description || '';

                    productCard.innerHTML = `
                        <div>
                            <div class="w-28 h-28 rounded-xl bg-slate-50 border border-slate-100 flex justify-center items-center p-2 mb-4 mx-auto overflow-hidden">
                                <img src="/storage/${product.image}" alt="${product.name}" class="taste-photo-zoom max-w-full max-h-full object-contain" />
                            </div>
                            <div class="flex items-center justify-center gap-1 text-amber-400 mb-2">
                                ${Array(starsCount).fill('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/></svg>').join('')}
                            </div>
                            <h3 class="font-bold text-slate-900 text-center text-base leading-snug mb-2 font-display">${product.name}</h3>
                            <p class="text-sm text-slate-600 text-center leading-relaxed font-normal line-clamp-3">${description}</p>
                        </div>
                        <div class="w-full pt-4 mt-4 border-t border-slate-100">
                            <a href="/quote?type=product&id=${product.id}" class="taste-btn w-full h-11 px-4 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-xs tracking-wider text-center uppercase flex items-center justify-center gap-2">
                                <span>{{__('messages.supplier.supplier_section.quote_now')}}</span>
                                <svg class="w-3.5 h-3.5 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    `;

                    productsContainer.appendChild(productCard);
                });


                productsContainer.classList.remove('hidden');
                loaderProductsContent.classList.add('hidden');
            } catch (error) {
                console.error('Error fetching products:', error);
                emptyProductsContent.classList.remove('hidden');
            }

        }

        function handleProductSearch() {
            if (searchProductInput.value && searchProductInput.value.length !== 0) {
                fetchProducts(1, searchProductInput.value);
            } else {
                fetchProducts(1);
            }
            scrollToProductsSections();
        }

        // Add event listeners
        searchProductBtn.addEventListener('click', handleProductSearch);
        searchProductInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                handleProductSearch();
            }
        });

        function scrollToProductsSections() {
            productsSections.scrollIntoView({ behavior: 'smooth' });
        }

        firstProductPageBtn.addEventListener('click',()=> {
            fetchProducts(1);
            scrollToProductsSections();
        })
        // Event listeners for pagination
        prevProductPageBtn.addEventListener('click', () => {
            if (currentProductPage > 1) {
                fetchProducts(currentProductPage - 1);
            }
            scrollToProductsSections();
        });

        nextProductPageBtn.addEventListener('click', () => {
            fetchProducts(currentProductPage + 1);
            scrollToProductsSections();
        });

        lastProductPageBtn.addEventListener('click',()=>{
            fetchProducts(lastProductPage);
            scrollToProductsSections();
        });


        // Initial load
        fetchProducts();
    });
</script>
@endpush
