@extends('layouts.client')


@section('content-client')
    <section id="suppliers_hero_section" class="w-full flex flex-col bg-slate-700 h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">
        <img src="/images/supplier.jpg" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
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
                    <img src={{$supplier['logo']}} class="w-[40%] h-auto"/>
                    <h5 class="font-bold text-white">{{$supplier['name']}}</h5>
                    <h1 class="font-bold text-white">Supplier Products</h1>
                    <div class="w-full flex flex-col sm:flex-row items-end sm:items-center justify-start gap-y-4 sm:gap-x-4 p-4 rounded-xl" style="background-color: rgba(255, 255, 255, 0.6);">
                        <input placeholder="Buscar Producto por EAN" class="uppercase w-full border-2 border-body rounded-md p-4 text-md font-bold focus:border-2 focus:border-primary focus:outline-none" />
                        <livewire:button-link text="Buscar" url="#" extraClasses="h-full uppercase font-bold"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="supplier_products" class="w-full flex flex-col h-auto padding gap-y-12">
        <div class="w-full h-auto flex flex-col justify-start items-center">
            <h5 class="animation-element slide-in-up text-primary">
                Encuentra tu Producto Ideal
            </h5>
            <h1 class="text-primary-dark font-bold animation-element slide-in-up text-center">
                Mira los Productos más pedidos ultimamente
            </h1>
        </div>
        <div class="h-full w-full grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 xl:gap-x-24 xl:gap-y-12 animation-group">
            @if(!empty($supplier['products']) && isset($supplier['products'][0]))
                @foreach ($supplier['products'] as $product)
                    <div class="col-span-1 row-span-1 flex flex-col justify-center items-start animation-element slide-in-right">
                        <div class="w-full xl:w-[350px] h-auto x:h-[500px] hover:-translate-y-[20px] duration-300">
                            <x-product-card :product="$product" />
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-1 sm:col-span-2 xl:col-span-3 flex flex-col items-center justify-center py-24 gap-y-12">
                    <h5 class="font-bold text-primary">Currently no Products for this Supplier</h5>
                    <img src="/images/svg/empty.svg" class="h-48 w-auto"/>
                </div>
            @endif
        </div>
    </section>
    <x-suppliers-section  header="Encuentra otro  Proveedor" title="Otros proveedores que venden productos similares" />
@endsection
