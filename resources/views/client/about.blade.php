@section('meta_description', __('messages.meta.aboutus'))
@extends('layouts.client')


@section('content-client')
    <section id="aboutus_hero_section" class="w-full flex flex-col h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">
        <img src="{{ asset('storage/'.'images/web/aboutus.webp') }}" alt="about_us_hero_image" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center xl:justify-end xl:items-end gap-y-12">

                <div class="w-full xl:w-[60%] h-auto flex flex-col gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2">
                        <h5 class="font-bold xl:text-right">{{ __('messages.about.hero.header') }}</h5>
                        <h1 class="font-bold xl:text-right">{{ __('messages.about.hero.title') }}</h1>
                    </div>
                    <label class="font-bold xl:text-right">{{ __('messages.about.hero.description') }}</label>

                    <div class="w-auto h-auto
                        flex flex-col xl:flex-row justify-start xl:justify-end max-xl:gap-y-4 xl:gap-x-4 items-start xl:items-center mt-12">

                        @if(!empty($services) && isset($services[0]))
                            <a href="{{ route('service', $services[0]['id']) }}"
                                aria-label="{{__('messages.aria_labels.default')}}"
                                title="{{__('messages.titles.default')}}"
                                class="inline-flex gap-x-4 justify-center items-center  border-2 px-12 sm:px-24 py-2 lg:py-3 sm:py-4 bg-white text-primary border-white hover:border-primary hover:bg-primary hover:text-white
                                duration-300 active:scale-95 rounded-xl transition">
                                <h5 >{{$services[0]['name']}}</h5>
                                <!-- Render right icon using Blade UI Kit -->

                                <?php
                                    $svgContent = file_get_contents(storage_path('app/public/' . $services[0]['icon'] ));
                                ?>
                                <span class="ml-2 w-6 sm:w-8 h-6 sm:h-8">
                                    {!! $svgContent !!}
                                </span>
                            </a>
                        @endif

                        @if(!empty($services) && isset($services[1]))

                            <a href="{{ route('service', $services[1]['id']) }}"
                                aria-label="{{__('messages.aria_labels.default')}}"
                                title="{{__('messages.titles.default')}}"
                                class="inline-flex gap-x-4 justify-center items-center  border-2 px-12 sm:px-24 py-2 lg:py-3 sm:py-4 bg-white text-primary border-white hover:border-primary hover:bg-primary hover:text-white
                                duration-300 active:scale-95 rounded-xl transition">
                                <h5 >{{$services[1]['name']}}</h5>
                                <!-- Render right icon using Blade UI Kit -->

                                <?php
                                    $svgContent2 = file_get_contents(storage_path('app/public/' . $services[1]['icon'] ));
                                ?>
                                <span class="ml-2 w-6 sm:w-8 h-6 sm:h-8">
                                    {!! $svgContent2 !!}
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="about_us_statistics"
    class="w-full h-auto grid grid-cols-2 xl:grid-cols-3 padding gap-x-6 gap-y-6 animation-group items-start">

    <div class="col-span-1 w-full animation-element text-animation grid grid-rows-[auto_auto_1fr] items-start">
        <h1 class="font-bold text-primary leading-none">
            {{ __('messages.about.statistics.stats_1_value') }}
        </h1>

        <span class="w-full xl:w-[80%] h-[3px] bg-primary my-2"></span>

        <h5 class="text-body leading-snug min-h-[3rem] sm:min-h-0">
            {{ __('messages.about.statistics.stats_1_label') }}
        </h5>
    </div>

    <div class="col-span-1 w-full animation-element text-animation grid grid-rows-[auto_auto_1fr] items-start">
        <h1 class="font-bold text-primary leading-none">
            {{ __('messages.about.statistics.stats_2_value') }}
        </h1>

        <span class="w-full xl:w-[80%] h-[3px] bg-primary my-2"></span>

        <h5 class="text-body leading-snug min-h-[3rem] sm:min-h-0">
            {{ __('messages.about.statistics.stats_2_label') }}
        </h5>
    </div>

    <div class="hidden col-span-1 xl:grid w-full animation-element text-animation grid-rows-[auto_auto_1fr] items-start">
        <h1 class="font-bold text-primary leading-none">
            {{ __('messages.about.statistics.stats_3_value') }}
        </h1>

        <span class="w-full xl:w-[80%] h-[3px] bg-primary my-2"></span>

        <h5 class="text-body leading-snug min-h-[3rem] sm:min-h-0">
            {{ __('messages.about.statistics.stats_3_label') }}
        </h5>
    </div>

    </section>
    <x-calculator-shipping />
    <x-content-section
        header="{{ __('messages.about.content.header') }}"
        title="{{ __('messages.about.content.title') }}"
        svgContent="images/web/aboutus_1.svg"
        introduction="{{ __('messages.about.content.introduction') }}"
        content1="{{ __('messages.about.content.content1') }}"
        content2="{{ __('messages.about.content.content2') }}"
    />
    <x-content-link-section
        header="{{ __('messages.about.content_link.header') }}"
        title="{{ __('messages.about.content_link.title') }}"
        svgContent="images/web/aboutus_2.svg"
        button="{{ __('messages.about.content_link.button_label') }}"
        content="{{ __('messages.about.content_link.content') }}"
        href="{{ route('quote') }}"
    />
    <x-services-section />
    <x-blogs-carousel :blogs="$blogs" />
@endsection
