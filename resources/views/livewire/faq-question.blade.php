<div id="question_{{$id}}" class="w-[1200px] h-auto flex flex-col p-4">
    <div class="w-full h-auto flex flex-row justify-between items-center py-4">
        <h3 class="text-secondary-dark">{{ $question }}</h3>
        <div wire:click="toggle" class="h-12 w-12 rounded-full flex items-center justify-center bg-gray-light p-3 hover:bg-secondary-dark hover:cursor-pointer duration-300 hover:cursor-pointer active:scale-95 group">
            @if($isOpen)
                <x-heroicon-o-minus class="h-full w-full group-hover:text-white" />
            @else
                <x-heroicon-o-plus class="h-full w-full group-hover:text-white" />
            @endif
        </div>
    </div>
    <div class="w-full px-12 border-b-2 border-gray-light py-4 transition-all duration-300 overflow-y-scroll {{ $isOpen ? 'h-[100px]' : 'h-[0px]' }} no-scroll-bar">
        <p class="w-full h-full transition-all duration-300 {{ $isOpen ? 'opacity-100' : 'opacity-0' }}">
            {{ $answer }}
        </p>

    </div>
</div>
