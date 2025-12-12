<section id="content_section" class="w-full h-auto bg-white text-body">
    <div class="relative w-full h-full padding flex flex-col xl:flex-row justify-start items-start gap-y-6 sm:gap-x-12 xl:gap-x-24 animation-group">
        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start items-start gap-y-6 ">
            <div class="h-auto h-full w-full flex flex-col justify-start items-start relative">
                <h5 class="animation-element slide-in-up">
                    {{$header}}
                </h5>
                <h1 class="text-primary-dark font-bold animation-element slide-in-up z-[10]">
                    {{$title}}
                </h1>
                <div class="xl:absolute xl:-bottom-72 xl:-left-36 w-full h-full flex justify-center items-center p-6 sm:p-4 mt-6 sm:mt-12 animation-element slide-in-up ">
                    <img src="{{ asset('storage/'. $svgContent)}}" alt="content_section_image" class="h-auto xl:h-[400px] w-auto" />
                </div>
            </div>
        </div>

        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start xl:justify-center items-start gap-y-6 animation-group">
            <h5 class="font-bold animation-element slide-in-up text-md/5 sm:text-lg/6 lg:text-2xl/7">{{$introduction}}</h5>
            <span class="font-bold animation-element slide-in-up text-sm/5 sm:text-md/6 lg:text-lg/6">{{$content1}}</span>
            <p class="animation-element slide-in-up text-sm/5 sm:text-md/6 lg:text-lg/6">{{$content2}}</p>
        </div>
    </div>
</section>
