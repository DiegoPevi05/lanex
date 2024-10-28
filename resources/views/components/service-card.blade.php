<?php
// Assuming $icon contains the file name or path within `storage`
$svgContent = file_get_contents(storage_path('app/public/' . $icon));
?>

<a href="{{ route('service', $id) }}"  class="w-full h-full flex flex-col bg-secondary rounded-xl px-4 py-6 sm:p-8 xl:p-12 active:scale-95 duration-300 hover:cursor-pointer hover:bg-primary group animation-element slide-in-down">
    <div class="h-1/2 w-full flex flex-row justify-start items-start">
        <div class="h-16 sm:h-20 w-16 sm:w-20 flex justify-center items-center bg-secondary-dark rounded-xl p-4 group-hover:bg-white">
            <div class="w-full h-full text-white group-hover:text-primary">
                {!! $svgContent !!}
            </div>
        </div>
    </div>
    <div class="h-1/2 w-full flex flex-col justify-start items-start pt-4">
        <h4 class="font-bold text-primary group-hover:text-white">
            {{$name}}
        </h4>
        <p class="group-hover:text-white">
            {{$description}}
        </p>

    </div>
</a>
