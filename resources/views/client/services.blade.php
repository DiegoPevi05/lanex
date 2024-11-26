@extends('layouts.client')


@section('content-client')
    <section id="home_hero_section" class="w-full flex flex-col h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">
        <img src="{{ asset('storage/'. '/images/web/services.webp' ) }}" alt="services_hero_image" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
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
    <x-brands  title="{{ __('messages.service.brands.title') }}" variant='secondary' :suppliers="$suppliers"/>
    <x-content-section
        header="Nivel Mundial"
        title="Envios Maritimos En todo momento"
        svgContent="images/web/statistics.svg"
        introduction="At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences."
        content1="At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences."
        content2="At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimoAt FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimo At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimo At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs. With years of experience and a team of experts, we are dedicated to empowering your business with seamless shipping experiences.Envío marítimo"
    />
    <x-content-link-section
        header="Encabezado"
        title="Dialoga con Expertos"
        svgContent="images/web/truck_delivery.svg"
        button="Cotiza Ahora"
        content="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
        href="{{ route('quote') }}"
    />
    <x-services-section />
@endsection
