@section('meta_description', __('messages.meta.service'))
@extends('layouts.client')


@section('content-client')
    <section id="home_hero_section" class="w-full flex flex-col bg-slate-700 min-h-[100svh] pt-[80px] xl:pt-[140px] relative z-10 text-white bg-green-100">
        @if(!empty($service['webcontent']['image']))
            <img src="{{ asset('storage/' . $service['webcontent']['image'])}}" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20">
        @endif
        <div class="w-full min-h-[calc(100svh-80px)] xl:min-h-[calc(100svh-140px)] padding-x padding-b z-30">
            <div class="w-full min-h-[calc(100svh-80px)] xl:min-h-[calc(100svh-140px)] flex flex-col justify-center xl:justify-end xl:items-end gap-y-12">

                <div class="w-full xl:w-[60%] h-auto flex flex-col gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2">
                        @if(!empty($service['webcontent']['header']))
                            <h5 class="font-bold xl:text-right">{{$service['webcontent']['header']}}</h5>
                        @endif
                        @if(!empty($service['webcontent']['title']))
                            <h1 class="font-bold xl:text-right">{{$service['webcontent']['title']}}</h1>
                        @endif
                    </div>
                    @if(!empty($service['webcontent']['description']))
                        <label class="font-bold xl:text-right">{{$service['webcontent']['description']}}</label>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if($service->suppliers->isNotEmpty())
        <x-brands  title="{{ __('messages.service.brands.title') }}" variant='secondary' :suppliers="$service->suppliers"/>
    @endif

    @if(!empty($service['webcontent']['overview']['title']) || !empty($service['webcontent']['overview']['header']))
        <x-content-section
            header="{{$service['webcontent']['overview']['header'] ?? ''}}"
            title="{{$service['webcontent']['overview']['title'] ?? ''}}"
            svgContent="{{$service['webcontent']['overview']['image'] ?? ''}}"
            introduction="{{$service['webcontent']['overview']['content']['header'] ?? ''}}"
            content1="{{$service['webcontent']['overview']['content']['introduction'] ?? ''}}"
            content2="{{$service['webcontent']['overview']['content']['content'] ?? ''}}"
        />
    @endif

    @if(!empty($service['webcontent']['content_link']['title']) || !empty($service['webcontent']['content_link']['header']))
        <x-content-link-section
            header="{{$service['webcontent']['content_link']['header'] ?? ''}}"
            title="{{$service['webcontent']['content_link']['title'] ?? ''}}"
            svgContent="{{$service['webcontent']['content_link']['image'] ?? ''}}"
            button="{{$service['webcontent']['content_link']['button_label'] ?? ''}}"
            content="{{$service['webcontent']['content_link']['content'] ?? ''}}"
            href="{{ route('quote') }}"
        />
    @endif

    @if(!empty($service['webcontent']['keypoints']['points']))
        <section id="service_key_points" class="w-full flex flex-col h-auto xl:h-screen padding">
            <div class="h-auto xl:h-[30%] w-full flex flex-col xl:flex-row justify-between items-center relative">
                <div class="w-full h-auto flex flex-col justify-start items-start">
                    @if(!empty($service['webcontent']['keypoints']['header']))
                        <h5 class="animation-element slide-in-up text-primary">
                            {{$service['webcontent']['keypoints']['header']}}
                        </h5>
                    @endif
                    @if(!empty($service['webcontent']['keypoints']['title']))
                        <h1 class="text-primary-dark font-bold animation-element slide-in-up">
                            {{$service['webcontent']['keypoints']['title']}}
                        </h1>
                    @endif
                </div>
                <div class="w-auto h-full flex justify-center items-center p-6 sm:p-4 animation-element slide-in-up">
                    <img src="/images/svg/services_3.svg" class="h-full w-auto" />
                </div>
            </div>
            <div class="h-full w-full grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 xl:grid-rows-2 gap-6 xl:gap-12 animation-group">

                @foreach ($service['webcontent']['keypoints']['points'] as $point)
                    <div class="col-span-1 row-span-1 flex flex-col justify-center items-start animation-element slide-in-right">
                        <label class="font-bold text-primary text-lg/5 sm:text-xl/5 lg:text-2xl/6">
                            {{$point['title'] ?? ''}}
                        </label>
                        <p class="text-sm/5 sm:text-md/5 pt-4 lg:text-lg/6 sm:pt-2">
                            {{$point['content'] ?? ''}}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if(!empty($service['webcontent']['faqs']['questions']))
        <x-questions
            title="{{ $service['webcontent']['faqs']['title'] ?? '' }}"
            :questions="$service['webcontent']['faqs']['questions']"
        />
    @endif
@endsection
