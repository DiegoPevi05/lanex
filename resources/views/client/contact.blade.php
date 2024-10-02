@extends('layouts.client')


@section('content-client')
    <section id="home_hero_section" class="w-full flex flex-col bg-slate-700 h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white bg-green-100">
        <img src="/images/home.jpg" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover blur-xs z-20">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center xl:justify-end gap-y-12">

                <div class="w-full xl:w-[60%] h-auto flex flex-col gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2">
                        <h5 class="font-bold">SOMOS LA MEJOR COMPAÑIA DE LOGISTICA</h5>
                        <h1 class="font-bold">Optimice sus envíos con nuestros servicios de carga</h1>
                    </div>
                    <label class="font-bold">Simplifica tu proceso de envío y hazlo más eficiente con nuestros servicios de carga. De principio a fin, nos encargaremos de todo para garantizar que su carga llegue de manera segura.</label>
                </div>

                <div class="h-auto w-full flex flex-col xl:flex-row items-start justify-between">
                    <div class="w-full h-auto flex flex-row justify-start  items-center gap-x-6 animation-group">
                        <div class="w-auto h-auto
                            animation-element slide-in-right
                            flex flex-col items-start justify-start
                            p-2
                            bg-primary rounded-xl">
                            <h1 class="font-bold text-[32px] sm:!text-[48px]">26 K</h1>
                            <p class="font-bold">Clientes Satisfechos</p>
                        </div>

                        <div class="w-auto h-auto
                            flex flex-col items-start justify-start
                            animation-element slide-in-right
                            p-2
                            bg-primary rounded-xl">
                            <h1 class="font-bold text-[32px] sm:!text-[48px]">12 +</h1>
                            <p class="font-bold">Clientes Satisfechos</p>
                        </div>

                    </div>
                    <div class="max-sm:m-none max-xl:ml-auto w-auto h-auto pt-6 sm:pt-12 xl:pt-24 animation-element slide-in-left">
                        <livewire:search-form />
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
