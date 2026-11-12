@php
    $rawSvgContent = trim($svgContent ?? '');
    $combined = mb_strtolower(($header ?? '') . ' ' . ($title ?? '') . ' ' . ($introduction ?? '') . ' ' . $rawSvgContent);

    if (str_starts_with($rawSvgContent, 'scene:')) {
        $sceneType = substr($rawSvgContent, 6);
    } elseif (!empty($rawSvgContent) && !str_starts_with($rawSvgContent, '/images/web/') && (str_starts_with($rawSvgContent, '/images/service/') || preg_match('/\.(svg|png|jpe?g|webp|gif)$/i', $rawSvgContent))) {
        $sceneType = $rawSvgContent;
    } elseif (str_contains($combined, 'asesoría especializada')) {
        $sceneType = 'route';
    } elseif (str_contains($combined, 'coordinación integral') || str_contains($combined, 'puerta a puerta')) {
        $sceneType = 'truck';
    } elseif (str_contains($combined, 'quiénes somos') || str_contains($combined, 'almacen')) {
        $sceneType = 'walkers';
    } elseif (str_contains($combined, 'aduan')) {
        $sceneType = 'ship';
    } elseif (str_contains($combined, 'marítimo') || str_contains($combined, 'aéreo') || str_contains($combined, 'usa') || str_contains($combined, 'mundial')) {
        $sceneType = 'plane';
    } else {
        $sceneType = 'walkers';
    }
@endphp

<!-- resources/views/components/content-section.blade.php -->
<section id="content_section" class="scroll-svg-section w-full bg-white text-slate-900 py-16 sm:py-24 border-b border-slate-200/80" data-scroll-title="{{ $header ?: 'Operaciones' }}">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Left Column: Animated SVG Illustration -->
            <div class="lg:col-span-5 order-2 lg:order-1">
                <x-animated-logistics-scene :scene="$sceneType" :title="$title" />
            </div>

            <!-- Right Column: Narrative Content -->
            <div class="lg:col-span-7 order-1 lg:order-2 flex flex-col items-start">
                @if(!empty($header))
                    <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-2.5">
                        {{ $header }}
                    </span>
                @endif

                @if(!empty($title))
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight leading-tight mb-5 font-display">
                        {{ $title }}
                    </h2>
                @endif

                @if(!empty($introduction))
                    <p class="text-base sm:text-lg font-medium text-slate-800 leading-relaxed mb-4">
                        {{ $introduction }}
                    </p>
                @endif

                @if(!empty($content1))
                    <p class="text-base font-normal text-slate-600 leading-relaxed mb-4">
                        {{ $content1 }}
                    </p>
                @endif

                @if(!empty($content2))
                    <p class="text-base font-normal text-slate-600 leading-relaxed mb-6">
                        {{ $content2 }}
                    </p>
                @endif

                <!-- CTA buttons -->
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <a
                        href="{{ $ctaUrl ?? route('quote') }}"
                        class="taste-btn inline-flex items-center gap-2 h-11 px-6 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm group"
                    >
                        <span>{{ $ctaText ?? 'Solicitar Asesoría Personalizada' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a
                        href="{{ route('services') }}"
                        class="taste-btn inline-flex items-center gap-2 h-11 px-5 rounded-xl border border-slate-300 hover:border-slate-900 text-slate-700 hover:text-slate-900 font-semibold text-sm"
                    >
                        <span>{{ __('Ver Nuestros Servicios') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
