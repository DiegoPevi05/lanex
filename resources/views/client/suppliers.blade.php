@extends('layouts.client')


@section('content-client')
    <section id="suppliers_hero_section" class="w-full flex flex-col h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">

        <img src="/images/localization.jpg" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center gap-y-12 animation-group">

                <div class="w-full xl:w-full h-auto flex flex-col justify-center items-center gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2 justify-center items-center">
                        <h5 class="font-bold">Compartimos contigo un poco de nuestro trabajo</h5>
                        <h1 class="font-bold">Enterate de todos nuestros Proveedores</h1>
                    </div>
                </div>
                <div class="w-full h-auto flex flex-col items-start justify-start text-body gap-y-1 bg-white p-6 rounded-xl animation-element slide-in-up">
                    <div class="w-full flex flex-col sm:flex-row items-end sm:items-center justify-start gap-y-4 sm:gap-x-4">
                        <input placeholder="Localizacion" class="uppercase w-full border-2 border-body rounded-md p-4 text-md font-bold focus:border-2 focus:border-primary focus:outline-none" />
                        <livewire:button-link text="Buscar" url="#" extraClasses="h-full uppercase font-bold"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-suppliers-section  header="Encuentra tu Producto Ideal" title="Algunas de Nuestros Proveedores mas Remarcables" />
@endsection
