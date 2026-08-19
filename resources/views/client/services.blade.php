@section('meta_description', __('messages.meta.services'))
@extends('layouts.client')


@section('content-client')
    <section id="home_hero_section" class="w-full flex flex-col min-h-[100svh] pt-[80px] xl:pt-[140px] relative z-10 text-white">
        <img src="{{ asset('storage/'. '/images/web/services.webp' ) }}" alt="services_hero_image" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full min-h-[calc(100svh-80px)] xl:min-h-[calc(100svh-140px)] padding-x padding-b z-30">
            <div class="w-full min-h-[calc(100svh-80px)] xl:min-h-[calc(100svh-140px)] flex flex-col justify-center xl:justify-end xl:items-end gap-y-12">

                <div class="w-full xl:w-[60%] h-auto flex flex-col gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2">
                        <h5 class="font-bold xl:text-right">{{ __('messages.services.header') }}</h5>
                        <h1 class="font-bold xl:text-right">{{ __('messages.services.title') }}</h1>
                    </div>
                    <label class="font-bold xl:text-right">{{ __('messages.services.subheader') }}</label>
                </div>
            </div>
        </div>
    </section>
    <x-brands  title="{{ __('messages.service.brands.title') }}" variant='secondary' :suppliers="$suppliers"/>
    <x-content-section
        header="{{ __('messages.services.content.header') }}"
        title="{{ __('messages.services.content.title') }}"
        svgContent="images/web/statistics.svg"
        introduction="{{ __('messages.services.content.introduction') }}"
        content1="{{ __('messages.services.content.content1') }}"
        content2="{{ __('messages.services.content.content2') }}"
    />
    <x-content-link-section
        header="{{ __('messages.services.link_section.header') }}"
        title="{{ __('messages.services.link_section.title') }}"
        svgContent="images/web/truck_delivery.svg"
        button="{{ __('messages.services.link_section.button') }}"
        content="{{ __('messages.services.link_section.content') }}"
        href="{{ route('quote') }}"
    />
    <x-calculator-shipping />
    <x-services-section />
    <x-blogs-carousel :blogs="$blogs" />
@endsection
