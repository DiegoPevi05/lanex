@section('meta_description', __('messages.meta.home'))
@extends('layouts.client')

@section('content-client')
    <section id="blog-hero-section" class="w-full flex flex-col h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">

        <img src="{{ asset('storage/'. $blog->featured_image)}}" alt="suppliers_hero_image" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center gap-y-12 animation-group">

                <div class="w-full h-auto flex flex-col justify-center items-center gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2 justify-center items-start lg:items-center">
                        <h5 class="font-bold text-left lg:text-center text-3xl">{{ $blog->title }}</h5>
                        <h1 class="font-bold text-left lg:text-center text-5xl">{{ $blog->sub_header }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="blog-content" class="relative w-full min-h-[100vh] flex flex-col justify-start items-start padding overflow-hidden">
        <div class="absolute w-[70vh] h-[70vh] top-0 right-0 overflow-hidden">
            <div class="relative w-full h-full blog-curved-image">
                <img src="{{ asset('storage/'. $blog->thumbnail_image)}}" alt="suppliers_hero_image" class="w-full h-full object-center object-cover">
            </div>
        </div>
        <div class="w-[calc(100%-70vh)] h-full flex flex-col justify-start items-start gap-y-4 animation-element slide-in-up">
            <span class="w-full flex flex-row justify-start items-center gap-x-4">
                <h1 class="font-bold text-left lg:text-center text-primary capitalize">{{ $blog->title }}</h1>
                <a href="{{ route('home') }}" class="text-left text-xl lg:text-center text-white bg-primary rounded-lg p-2 active:scale-95 duration-300 hover:bg-primary-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-link h-full w-full"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                </a>
            </span>
            <p class="text-left text-xl lg:text-center text-gray-500 capitalize">{{ $blog->content }}</p>

            <p class="text-gray-500 mt-auto">
                {{ __('messages.home.blogs.author') }} <strong>{{ $blog->author }}</strong> 
            </p>
        </div>
    </section>
@endsection