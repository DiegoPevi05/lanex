@extends('layouts.client')


@section('content-client')
    <section id="aboutus_hero_section" class="w-full flex flex-col h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">
        <img src="/images/aboutus.jpg" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center xl:justify-end xl:items-end gap-y-12">

                <div class="w-full xl:w-[60%] h-auto flex flex-col gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2">
                        <h5 class="font-bold xl:text-right">SOMOS LA MEJOR COMPAÑIA DE LOGISTICA</h5>
                        <h1 class="font-bold xl:text-right">Optimice sus envíos con nuestros servicios de carga</h1>
                    </div>
                    <label class="font-bold xl:text-right">Simplifica tu proceso de envío y hazlo más eficiente con nuestros servicios de carga. De principio a fin, nos encargaremos de todo para garantizar que su carga llegue de manera segura.</label>

                    <div class="w-auto h-auto
                        flex flex-col xl:flex-row justify-start xl:justify-end max-xl:gap-y-4 xl:gap-x-4 items-start xl:items-center mt-12">
                        <livewire:button-link url="#" size="lg" variant="secondary" text="Envio Maritimo" rightIcon="ri-ship-fill" />
                        <livewire:button-link url="#" size="lg" variant="secondary" text="Envio Aereo" rightIcon="bi-airplane-fill" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="about_us_statistics" class="w-full h-auto grid grid-cols-2 xl:grid-cols-3 padding gap-x-6 animation-group">
        <div class="col-span-1 flex flex-col items-start justify-center w-full animation-element text-animation">
            <h1 class="font-bold text-primary">+120</h1>
            <span class="w-full xl:w-[80%] h-[3px] bg-primary"></span>
            <h5 class="text-body">Paises para Exportar</h5>
        </div>

        <div class="col-span-1 flex flex-col items-start justify-center w-full animation-element text-animation">
            <h1 class="font-bold text-primary">+120</h1>
            <span class="w-full xl:w-[80%] h-[3px] bg-primary"></span>
            <h5 class="text-body">Paises para Exportar</h5>
        </div>

        <div class="hidden col-span-1 xl:flex flex-col items-start justify-center w-full animation-element text-animation">
            <h1 class="font-bold text-primary">+120</h1>
            <span class="w-full xl:w-[80%] h-[3px] bg-primary"></span>
            <h5 class="text-body">Paises para Exportar</h5>
        </div>
    </section>
    <x-content-section
        header="Quienes Somos?"
        title="Somos una compañia Experta en Logistica"
        svgContent="/images/svg/aboutus_1.svg"
        introduction="At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences."
        content1="At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences."
        content2="At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimoAt FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimo At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimo At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimo"
    />
    <x-content-link-section
        header="Encabezado"
        title="Dialoga con Expertos"
        svgContent="/images/svg/aboutus_2.svg"
        button="COTIZA AHORA"
        content="At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimoAt FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimo At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs."
        href="{{ route('services') }}"
    />
    <x-services-section />
@endsection
