<div class="w-full h-12 flex flex-row justify-center items-center gap-x-5 sm:gap-x-8 mb-6">
    @foreach ($order->trackingSteps as $step)
        <!-- The before element pseudo-class -->
        <div class="relative h-10 sm:w-16 h-10 sm:h-16 p-none m-none">
            <div class="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 w-20 sm:w-32 h-1 sm:h-2 {{ $step->status == 'IN_TRANSIT' || $step->status == 'COMPLETED' ? 'bg-primary': 'bg-gray-light'  }} z-[10] {{ $loop->first || $loop->last ? 'rounded-xl' : '' }} "></div>
            <div class="w-full h-full rounded-full {{ $step->status == 'IN_TRANSIT' || $step->status == 'COMPLETED' ? 'bg-primary' : 'bg-gray-light' }} flex justify-center items-center p-[2px] sm:p-2 z-[20]">


                <!-- The icon component -->
                <div class="w-full h-full rounded-full bg-white flex justify-center items-center z-[20] p-2">

                    <?php
                    // Assuming $icon contains the file name or path within `storage`
                    $svgContent = file_get_contents(storage_path('app/public/' . $step->transportType->icon));
                    ?>
                    <div class="w-full h-full {{ $step->status == 'IN_TRANSIT' || $step->status == 'COMPLETED' ? 'text-primary' : 'text-body' }}">
                        {!! $svgContent !!}
                    </div>
                </div>
            </div>
            <div class="absolute top-full left-1/2 -translate-x-1/2 w-auto mt-2">
                <p class="text-[10px] sm:text-xs text-nowrap">{{$step->transportType->type}}</p>
            </div>
        </div>
    @endforeach
</div>