<div id="sub_section_{{$id}}" data-id="{{$id}}" class="w-full h-auto flex flex-col my-4">
    <div class="w-full h-auto flex flex-row justify-between items-center py-2">
        <label class="text-secondary-dark text-lg font-bold capitalize max-w-[80%]">{{ __($title) }}</label>
        <div id="toggleButton_{{$id}}" class="h-8 sm:h-12 w-8 sm:w-12 rounded-full flex items-center justify-center bg-gray-light sm:p-3 hover:bg-secondary-dark hover:cursor-pointer duration-300 active:scale-95 group">
            <div id="iconOpen_{{$id}}" class="w-full h-full flex justify-center items-center">
                <span class="h-5 sm:h-full w-5 sm:w-full group-hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
                </span>
            </div>
            <div id="iconClose_{{$id}}" class="hidden w-full h-full flex justify-center items-center">
                <span class="h-5 sm:h-full w-5 sm:w-full group-hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-up"><path d="m18 15-6-6-6 6"/></svg>
                </span>
            </div>
        </div>
    </div>
    <div id="wrapperContainer_{{$id}}" class="w-full px-none border-b-2 border-gray-light pb-2 transition-all duration-300 overflow-y-scroll h-[0px] no-scroll-bar">
        <div id="wrapper_{{$id}}" class="w-full h-full transition-all duration-300 opacity-0">
            {{$slot}}
        </div>
    </div>
</div>
