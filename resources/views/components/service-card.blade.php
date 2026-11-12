<?php
$svgContent = '';
if (!empty($icon) && file_exists(storage_path('app/public/' . $icon))) {
    $svgContent = file_get_contents(storage_path('app/public/' . $icon));
}
$displayImage = !empty($image) ? $image : '/images/service/service_agencia_carga.jpg';
?>

<a href="{{ route('service', $id) }}"
   class="taste-card-link w-full h-full flex flex-col bg-white border border-slate-200/90 hover:border-primary/50 rounded-2xl overflow-hidden hover:shadow-lg group">

    <!-- Service Header Photography -->
    <div class="relative h-52 w-full overflow-hidden bg-slate-900 shrink-0">
        <img
            src="{{ asset('storage/' . ltrim($displayImage, '/')) }}"
            alt="{{ $name }}"
            class="taste-photo-zoom w-full h-full object-cover object-center"
            loading="lazy"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/55 via-transparent to-transparent"></div>

        <!-- Themed Icon Badge -->
        <div class="absolute bottom-3 left-4 w-10 h-10 rounded-xl bg-white text-primary shadow-md border border-slate-200 flex justify-center items-center p-2 transition-colors duration-150 group-hover:bg-primary group-hover:text-white group-hover:border-primary">
            <div class="w-full h-full [&>svg]:w-full [&>svg]:h-full [&>svg]:max-w-full [&>svg]:max-h-full">
                {!! $svgContent !!}
            </div>
        </div>
    </div>

    <!-- Service Content -->
    <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 gap-4">
        <div class="flex flex-col gap-2">
            <h3 class="font-bold text-slate-900 group-hover:text-primary text-lg sm:text-xl tracking-tight leading-snug transition-colors duration-150 font-display">
                {{ $name }}
            </h3>
            <p class="text-slate-600 text-base leading-relaxed line-clamp-3 font-normal">
                {{ $description }}
            </p>
        </div>

        <div class="flex items-center text-xs font-bold text-primary group-hover:text-primary-dark pt-3.5 border-t border-slate-100 gap-1.5 transition-colors">
            <span>{{ __('Ver detalles del servicio') }}</span>
            <svg class="w-3.5 h-3.5 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </div>
    </div>
</a>
