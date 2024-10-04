<div class="w-full h-full flex flex-row justify-center items-center gap-x-5 sm:gap-x-8">
    @if(!empty($steps) && isset($steps[0]))
        @foreach ($steps as $step)

            <!-- The before element pseudo-class -->
            <div class="relative h-10 sm:w-16 h-10 sm:h-16 p-none m-none">
                <div class="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 w-20 sm:w-32 h-1 sm:h-2 {{$step['active'] ? 'bg-primary': 'bg-gray-light'  }} z-[10] {{ $loop->first || $loop->last ? 'rounded-xl' : '' }} "></div>
                <div class="w-full h-full rounded-full {{ $step['active'] ? 'bg-primary' : 'bg-gray-light' }} flex justify-center items-center p-[2px] sm:p-2 z-[20]">


                    <!-- The icon component -->
                    <div class="w-full h-full rounded-full bg-white flex justify-center items-center z-[20] p-2">
                        <x-dynamic-component :component="$step['icon']" class="w-full h-full {{ $step['active'] ? 'text-primary' : 'text-body' }}" />
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="w-full h-auto flex flex-col items-center justify-center py-24 gap-y-12">
            <h5 class="font-bold text-primary">No steps provided</h5>
            <img src="/images/svg/empty.svg" class="h-48 w-auto"/>
        </div>
    @endif
</div>
