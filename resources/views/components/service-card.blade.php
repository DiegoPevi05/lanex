<a href="{{ $route }}"  class="w-full h-full flex flex-col bg-secondary rounded-xl p-12 active:scale-95 duration-300 hover:cursor-pointer hover:bg-primary group">
    <div class="h-1/2 w-full flex flex-row justify-start items-start">
        <div class="h-20 w-20 flex justify-center items-center bg-secondary-dark rounded-xl p-4 group-hover:bg-white">
            <x-dynamic-component :component="$svgIcon" class="w-full h-full text-white group-hover:text-primary" />
        </div>
    </div>
    <div class="h-1/2 w-full flex flex-col justify-start items-start">
        <h4 class="font-bold text-primary group-hover:text-white">
            {{$header}}
        </h4>
        <p class="group-hover:text-white">
            {{$content}}
        </p>

    </div>
</a>
