@extends('layouts.client')


@section('content-client')
    <section id="home_hero_section" class="w-full flex flex-col bg-slate-700 h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white bg-green-100">
        <img src="/images/home.jpg" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center xl:justify-end gap-y-12">

                <div class="w-full xl:w-[60%] h-auto flex flex-col gap-y-4 animation-element slide-in-up">
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
                            <h1 class="font-bold text-[32px] sm:!text-[48px]">{{ __('messages.home.hero.card_1_number') }}</h1>
                            <p class="font-bold">{{ __('messages.home.hero.card_1_label') }}</p>
                        </div>

                        <div class="w-auto h-auto
                            flex flex-col items-start justify-start
                            animation-element slide-in-right
                            p-2
                            bg-primary rounded-xl">
                            <h1 class="font-bold text-[32px] sm:!text-[48px]">{{ __('messages.home.hero.card_2_number') }}</h1>
                            <p class="font-bold">{{ __('messages.home.hero.card_2_label') }}</p>
                        </div>

                    </div>
                    <div class="max-sm:m-none max-xl:ml-auto w-auto h-auto pt-6 sm:pt-12 xl:pt-24 animation-element slide-in-left">
                        <livewire:search-form />
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
                        <img src="/images/svg/aircraft.svg" class="w-auto h-full"/>
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
                        <img src="/images/svg/dollar.svg" class="w-full h-full"/>
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
                        <img src="/images/svg/package-check.svg" class="w-full h-full"/>

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
                        <img src="/images/svg/container.svg" class="w-full h-full"/>
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
    <section id="reviews" class="w-full h-auto xl:min-h-screen bg-white text-body">
        <div class="relative w-full h-full padding flex flex-col sm:flex-row justify-start items-start gap-y-6 sm:gap-x-12 xl:gap-x-24 animation-group">
            <div class="w-full sm:w-1/2 h-full flex flex-col justify-start items-start gap-y-6">
                <div class="h-auto sm:min-h-[500px] w-full flex flex-col justify-start items-start animation-element slide-in-up">
                    <h5>{{ __('messages.home.reviews.header') }}</h5>
                    <h1 class="text-primary-dark font-bold">
                        {{ __('messages.home.reviews.title') }}
                    </h1>
                    <div class="relative w-full h-full rounded-xl bg-secondary flex justify-center items-center p-6 sm:p-4 max-sm:mt-6">
                        <div class="absolute rounded-xl -top-6 sm:-top-12 -right-6 sm:-right-12 h-12 sm:h-24 w-12 sm:w-24 bg-primary-dark flex justify-center items-center">
                            <img src="{{ asset('storage/' . 'images/web/quotes.svg' ) }}" class="h-6 sm:h-12 w-6 sm:w-12" />

                        </div>
                        <img src="{{ asset('storage/' . 'images/web/review.svg') }}" class="h-[80%] w-auto" />
                    </div>
                </div>

                <div class="hidden sm:flex w-full h-full p-none m-none">
                    @if(!empty($reviews) && isset($reviews[0]))
                        <x-review
                            :stars="$reviews[0]['stars']"
                            :content="$reviews[0]['review']"
                            :name="$reviews[0]['name']"
                            :charge="$reviews[0]['charge']"
                            variant="secondary"
                        />
                    @endif
                </div>
            </div>

            <div class="w-full sm:w-1/2 h-full flex flex-col justify-start items-start gap-y-6 animation-group">

                <div class="flex sm:hidden w-full h-full p-none m-none">

                    @if(!empty($reviews) && isset($reviews[0]))
                    <x-review
                        :stars="$reviews[0]['stars']"
                        :content="$reviews[0]['review']"
                        :name="$reviews[0]['name']"
                        :charge="$reviews[0]['charge']"
                        variant="secondary"
                    />
                    @endif
                </div>

                @if(!empty($reviews) && isset($reviews[1]))
                <x-review
                    :stars="$reviews[1]['stars']"
                    :content="$reviews[1]['review']"
                    :name="$reviews[1]['name']"
                    :charge="$reviews[1]['charge']"
                />
                @endif

                @if(!empty($reviews) && isset($reviews[2]))
                <x-review
                    :stars="$reviews[2]['stars']"
                    :content="$reviews[2]['review']"
                    :name="$reviews[2]['name']"
                    :charge="$reviews[2]['charge']"
                />
                @endif

                @if(!empty($reviews) && isset($reviews[3]))
                <x-review
                    :stars="$reviews[3]['stars']"
                    :content="$reviews[3]['review']"
                    :name="$reviews[3]['name']"
                    :charge="$reviews[3]['charge']"
                />
                @endif

            </div>
        </div>
    </section>

@endsection
