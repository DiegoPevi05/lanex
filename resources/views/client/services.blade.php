@extends('layouts.client')


@section('content-client')
    <section id="home_hero_section" class="w-full flex flex-col h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">
        <img src="/images/services.jpg" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center xl:justify-end xl:items-end gap-y-12">

                <div class="w-full xl:w-[60%] h-auto flex flex-col gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2">
                        <h5 class="font-bold xl:text-right">SOMOS LA MEJOR COMPAÑIA DE LOGISTICA</h5>
                        <h1 class="font-bold xl:text-right">Optimice sus envíos con nuestros servicios de carga</h1>
                    </div>
                    <label class="font-bold xl:text-right">Simplifica tu proceso de envío y hazlo más eficiente con nuestros servicios de carga. De principio a fin, nos encargaremos de todo para garantizar que su carga llegue de manera segura.</label>
                </div>
            </div>
        </div>
    </section>
    <x-services-section />
@endsection
