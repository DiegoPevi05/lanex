@section('meta_description', __('messages.meta.home'))
@extends('layouts.client')


@section('content-client')
    <section id="home_hero_section" class="w-full flex flex-col bg-slate-700 h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white bg-green-100">
        <img src="{{ asset('storage/'.'images/web/home.webp') }}" alt="home_image" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center xl:justify-end gap-y-6">

                <div class="w-full xl:w-full h-auto flex flex-col gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2">
                        <h5 class="font-bold">{{ __('messages.home.hero.header') }}</h5>
                        <h1 class="font-bold">{{ __('messages.home.hero.title') }}</h1>
                    </div>
                    <label class="font-bold">{{ __('messages.home.hero.description') }}</label>
                </div>

                <div class="h-auto w-full flex flex-col xl:flex-row items-start justify-between">
                    <div class="w-full h-auto flex flex-row justify-start  items-center gap-x-6 animation-group">
                        <div class="w-auto h-auto
                            animation-element slide-in-right
                            flex flex-col items-start justify-start
                            p-2
                            bg-primary rounded-xl">
                            <h1 class="font-bold text-[2rem] sm:!text-[48px]">{{ __('messages.home.hero.card_1_number') }}</h1>
                            <p class="font-bold">{{ __('messages.home.hero.card_1_label') }}</p>
                        </div>

                        <div class="w-auto h-auto
                            flex flex-col items-start justify-start
                            animation-element slide-in-right
                            p-2
                            bg-primary rounded-xl">
                            <h1 class="font-bold text-[2rem] sm:!text-[48px]">{{ __('messages.home.hero.card_2_number') }}</h1>
                            <p class="font-bold">{{ __('messages.home.hero.card_2_label') }}</p>
                        </div>

                    </div>
                    <div class="max-sm:m-none max-xl:ml-auto w-auto h-auto pt-6 sm:pt-12 xl:pt-24 animation-element slide-in-left">
                            <div class="w-full h-auto flex flex-col">
                                <!-- Tabs -->
                                <div class="w-auto flex flex-row justify-start rounded-t-lg">
                                    <!-- Tab 1 -->
                                    <div class="cursor-pointer py-3 px-6 rounded-tl-lg text-primary-dark bg-white font-bold group">
                                         <label class="font-bold group-hover:cursor-pointer">Tracking</label>
                                    </div>
                                    <!-- Tab 2 -->
                                    <a href="{{route('quote')}}"
                                        aria-label="{{ __('messages.aria_labels.quote') }}"
                                        title="{{ __('messages.titles.quote') }}"
                                        class="cursor-pointer py-3 px-6 rounded-tr-lg bg-primary-dark group">
                                         <label class="font-bold group-hover:cursor-pointer">{{__('messages.common.quote')}}</label>
                                    </a>
                                </div>

                                <!-- Tab Content -->
                                <div class="bg-white w-full sm:w-96 md:w-[500px] flex shadow-md rounded-b-lg rounded-tr-lg p-4">
                                    <!-- Content for Tab 1 -->
                                    <div class="w-full h-auto flex flex-col items-start justify-start text-body gap-y-1">
                                        <div class="w-full flex flex-col sm:flex-row items-end sm:items-center justify-start gap-y-4 sm:gap-x-4">
                                            <input id="tracking_id_input" placeholder="Tracking ID" class="uppercase w-full border-2 border-body rounded-md p-4 text-md font-bold focus:border-2 focus:border-primary focus:outline-none" />
                                            <button id="tracking_id_btn" class=" duration-300 active:scale-95 rounded-xl transition h-full uppercase font-bold inline-flex gap-x-4 justify-center items-center  border-2  px-8 py-2  bg-primary hover:bg-primary-dark text-white border-primary hover:border-white">{{ __('messages.common.search') }}</button>
                                        </div>
                                        <p class="text-[12px]">{{ __('messages.home.hero.input_helper_text') }} <a href="https://wa.link/s7w6z3" target="_blank"
                                                aria-label="{{ __('messages.aria_labels.default') }}"
                                                title="{{ __('messages.titles.default') }}"
                                                class="text-primary underline cursor-pointer">{{ __('messages.home.hero.input_helper_help') }}</a></p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="home_step_guide" class="w-full h-auto sm:h-screen bg-white text-body">
        <div class="relative w-full h-full padding flex flex-col divide-y divide-primary gap-y-6">
            <div class="h-auto sm:h-1/2 w-full flex flex-col-reverse xl:flex-row gap-y-12 sm:gap-x-12 border-primary">
                <div class="w-full xl:w-1/2 h-full">
                    <div class="w-full h-full bg-secondary py-6 px-4 rounded-lg flex items-center justify-center">
                        <img src="storage/images/web/aircraft.svg" alt="home_airplane_icon" class="w-auto h-full"/>
                    </div>
                </div>

                <div class="w-full xl:w-1/2 h-full flex flex-col justify-center xl:justify-start items-start animation-element slide-in-up">
                    <h5 class="font-bold text-primary">
                        {{ __('messages.home.step.header') }}
                    </h5>
                    <h2 class="font-bold text-primary-dark">
                        {{ __('messages.home.step.title') }}
                    </h2>
                    <p class="max-xl:mt-4">
                        {{ __('messages.home.step.content') }}
                    </p>
                </div>

            </div>
            <div class="h-auto sm:h-1/2 w-full flex flex-col max-sm:items-center sm:flex-row gap-y-6 sm:gap-x-12 pt-6 animation-group">
                <div class="w-full sm:w-1/3 h-full flex flex-col items-center justify-center xl:justify-start gap-y-4 animation-element slide-in-left">
                    <div class="rounded-xl text-primary bg-transparent border-2 border-secondary shadow-sm py-1 px-4">
                        <p>
                            {{ __('messages.home.step.step_1_label') }}
                        </p>
                    </div>
                    <div class="rounded-xl flex items-center justify-center w-20 sm:w-36 h-20 sm:h-36 bg-primary p-4 sm:p-8">
                        <img src="storage/images/web/dollar.svg" alt="step_guide_dollar_icon" class="w-full h-full"/>
                    </div>
                    <h4 class="font-bold text-primary-dark text-center">

                        {{ __('messages.home.step.step_1_title') }}
                    </h4>
                </div>

                <div class="w-full sm:w-1/3 h-full flex flex-col items-center justify-center xl:justify-start gap-y-4 animation-element slide-in-left">
                    <div class="rounded-xl text-primary bg-transparent border-2 border-secondary shadow-sm py-1 px-4">
                        <p>
                            {{ __('messages.home.step.step_2_label') }}
                        </p>
                    </div>
                    <div class="rounded-xl flex items-center justify-center w-20 sm:w-36 h-20 sm:h-36 bg-primary p-4 sm:p-8">
                        <img src="storage/images/web/package-check.svg" alt="step_guide_package_icon" class="w-full h-full"/>

                    </div>
                    <h4 class="font-bold text-primary-dark text-center">
                        {{ __('messages.home.step.step_2_title') }}
                    </h4>
                </div>

                <div class="w-full sm:w-1/3 h-full flex flex-col items-center justify-center xl:justify-start gap-y-4 animation-element slide-in-left">
                    <div class="rounded-xl text-primary bg-transparent border-2 border-secondary shadow-sm py-1 px-4">
                        <p>
                            {{ __('messages.home.step.step_3_label') }}
                        </p>
                    </div>
                    <div class="rounded-xl flex items-center justify-center w-20 sm:w-36 h-20 sm:h-36 bg-primary p-4 sm:p-8">
                        <img src="storage/images/web/container.svg" alt="step_guide_container_icon" class="w-full h-full"/>
                    </div>
                    <h4 class="font-bold text-primary-dark text-center">
                        {{ __('messages.home.step.step_3_title') }}
                    </h4>
                </div>
            </div>
        </div>
    </section>
    <x-brands  title="{{ __('messages.home.brands') }}" :suppliers="$suppliers"/>
    <x-services-section />
    <x-questions title="{{ __('messages.home.questions.title') }}" :questions="$questions" />
    <x-blogs-carousel :blogs="$blogs" />

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('tracking_id_btn').addEventListener('click', function (e) {
            // Get the value from the input field
            const trackingIdInput = document.getElementById('tracking_id_input').value.trim();

            // Check if the input is empty
            if (!trackingIdInput) {
                return; // Prevent redirection if the input is empty
            }

            // Redirect to the track route with the tracking_id as a query parameter
            const routeUrl = "{{ route('track') }}";
            window.location.href = `${routeUrl}?order=${encodeURIComponent(trackingIdInput)}`;
        });

    });
</script>
@endpush
