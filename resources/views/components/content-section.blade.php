<section id="content_section" class="w-full h-auto xl:h-screen bg-white text-body">
    <div class="relative w-full h-full padding flex flex-col xl:flex-row justify-start items-start gap-y-6 sm:gap-x-12 xl:gap-x-24 animation-group">
        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start items-start gap-y-6 ">
            <div class="h-auto h-full w-full flex flex-col justify-start items-start relative">
                <h5 class="animation-element slide-in-up">
                    {{$header}}
                </h5>
                <h1 class="text-primary-dark font-bold animation-element slide-in-up">
                    {{$title}}
                </h1>
                <div class="xl:absolute xl:-left-36 w-full h-full flex justify-center items-center p-6 sm:p-4 mt-6 sm:mt-12 animation-element slide-in-up">
                    <img src="{{ asset('storage/'. $svgContent)}}" alt="content_section_image" class="h-[70%] w-auto" />
                </div>
            </div>
        </div>

        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start xl:justify-center items-start gap-y-6 animation-group">
            <h5 class="font-bold animation-element slide-in-up">{{$introduction}}</h5>
            <span class="font-bold animation-element slide-in-up">{{$content1}}</span>
            <p class="animation-element slide-in-up">{{$content2}}</p>
        </div>
    </div>
</section>
