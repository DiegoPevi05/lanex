<a href="{{ $url }}"
    class="inline-flex gap-x-4 items-center px-6 p-4
    bg-primary hover:bg-primary-dark duration-300 active:scale-95 text-white rounded-xl transition">

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

