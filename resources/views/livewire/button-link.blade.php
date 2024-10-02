<a href="{{ $url }}"
    class="inline-flex gap-x-4 justify-center items-center  border-2
    {{ $size ===  'md' ? 'px-8 py-2' : ($size === 'lg' ? 'px-12 sm:px-24 py-2 lg:py-3 sm:py-4': 'px-4 py-2') }}
    {{ $variant === 'primary' ? 'bg-primary hover:bg-primary-dark text-white border-primary hover:border-white' : '' }}
    {{ $variant === 'secondary' ? 'bg-white text-primary border-white hover:border-primary hover:bg-primary hover:text-white ' : '' }}
    {{ $variant === 'tertiary' ? 'bg-secondary-dark text-white border-secondary-dark hover:border-primary hover:bg-primary ' : '' }}
    {{ $variant === 'danger' ? 'bg-red-500 hover:bg-red-600' : '' }}
    duration-300 active:scale-95 rounded-xl transition {{ $extraClasses }}">

    @if($leftIcon)
        <!-- Render left icon using Blade UI Kit -->
        <span class="mr-2">
            <x-dynamic-component :component="$leftIcon" class="
                {{ $size == 'md' ? 'w-6 h-6' : ($size == 'lg' ? 'w-6 sm:w-8 h-6 sm:h-8' : 'w-6 h-6' ) }}
            " />
        </span>
    @endif

    @if($text != '')
        @if($size == 'lg')
            <h5 >{{ $text }}</h5>
        @elseif($size == 'sm')
            <p>{{ $text }}</p>
        @else
            <span>{{ $text }}</span>
        @endif
    @endif




    @if($rightIcon)
        <!-- Render right icon using Blade UI Kit -->
        <span class="ml-2">
            <x-dynamic-component :component="$rightIcon" class="
            {{ $size == 'md' ? 'w-6 h-6' : ($size == 'lg' ? 'w-6 sm:w-8 h-6 sm:h-8' : 'w-6 h-6' ) }}
            "/>
        </span>
    @endif
</a>

