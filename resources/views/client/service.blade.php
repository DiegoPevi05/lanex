@extends('layouts.client')


@section('content-client')
    <section id="home_hero_section" class="w-full flex flex-col bg-slate-700 h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white bg-green-100">
        <img src="{{ asset('storage/' . $service['webcontent']['image'])}}" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center xl:justify-end xl:items-end gap-y-12">

                <div class="w-full xl:w-[60%] h-auto flex flex-col gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2">
                        <h5 class="font-bold xl:text-right">{{$service['webcontent']['header']}}</h5>
                        <h1 class="font-bold xl:text-right">{{$service['webcontent']['title']}}</h1>
                    </div>
                    <label class="font-bold xl:text-right">{{$service['webcontent']['description']}}</label>
                </div>
            </div>
        </div>
    </section>
    <x-brands  title="{{ __('messages.service.brands.title') }}" variant='secondary' :suppliers="$service->suppliers"/>
    <x-content-section
        header="{{$service['webcontent']['overview']['header']}}"
        title="{{$service['webcontent']['overview']['title']}}"
        svgContent="{{$service['webcontent']['overview']['image']}}"
        introduction="{{$service['webcontent']['overview']['content']['header']}}"
        content1="{{$service['webcontent']['overview']['content']['introduction']}}"
        content2="{{$service['webcontent']['overview']['content']['content']}}"
    />
    <x-content-link-section
        header="{{$service['webcontent']['content_link']['header']}}"
        title="{{$service['webcontent']['content_link']['title']}}"
        svgContent="{{$service['webcontent']['content_link']['image']}}"
        button="{{$service['webcontent']['content_link']['button_label']}}"
        content="{{$service['webcontent']['content_link']['content']}}"
        href="{{ route('quote') }}"
    />
    <section id="service_key_points" class="w-full flex flex-col h-auto xl:h-screen padding">
        <div class="h-auto xl:h-[30%] w-full flex flex-col xl:flex-row justify-between items-center relative">
            <div class="w-full h-auto flex flex-col justify-start items-start">
                <h5 class="animation-element slide-in-up text-primary">
                    {{$service['webcontent']['keypoints']['header']}}
                </h5>
                <h1 class="text-primary-dark font-bold animation-element slide-in-up">
                    {{$service['webcontent']['keypoints']['title']}}
                </h1>
            </div>
            <div class="w-auto h-full flex justify-center items-center p-6 sm:p-4 animation-element slide-in-up">
                <img src="/images/svg/services_3.svg" class="h-full w-auto" />
            </div>
        </div>
        <div class="h-full w-full grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 xl:grid-rows-2 gap-6 xl:gap-12 animation-group">

            @foreach ($service['webcontent']['keypoints']['points'] as $point)
                <div class="col-span-1 row-span-1 flex flex-col justify-center items-start animation-element slide-in-right">
                    <label class="font-bold text-primary">
                        {{$point['title']}}
                    </label>
                    <p>
                        {{$point['content']}}
                    </p>
                </div>
            @endforeach
        </div>
    </section>
    <x-questions
        title="{{ $service['webcontent']['faqs']['title'] }}"
        :questions="$service['webcontent']['faqs']['questions']"
    />
@endsection
