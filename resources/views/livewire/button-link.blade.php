<a href="{{ $url }}"
    class="inline-flex gap-x-4 justify-center items-center px-6 py-2 border-2
    {{ $variant === 'primary' ? 'bg-primary hover:bg-primary-dark text-white border-primary hover:border-white' : '' }}
    {{ $variant === 'secondary' ? 'bg-white text-primary border-white hover:border-primary hover:bg-primary hover:text-white ' : '' }}
    {{ $variant === 'tertiary' ? 'bg-secondary-dark text-white border-secondary-dark hover:border-primary hover:bg-primary ' : '' }}
    {{ $variant === 'danger' ? 'bg-red-500 hover:bg-red-600' : '' }}
    duration-300 active:scale-95 rounded-xl transition {{ $extraClasses }}">

    @if($leftIcon)
        <!-- Render left icon using Blade UI Kit -->
        <span class="mr-2">
            <x-dynamic-component :component="$leftIcon" class="w-6 h-6" />
        </span>
    @endif

    <span>{{ $text }}</span>

    @if($rightIcon)
        <!-- Render right icon using Blade UI Kit -->
        <span class="ml-2">
            <x-dynamic-component :component="$rightIcon" class="w-6 h-6" />
        </span>
    @endif
</a>

