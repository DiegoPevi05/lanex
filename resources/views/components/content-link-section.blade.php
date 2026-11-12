@php
    $rawSvgContent = trim($svgContent ?? '');
    $combinedText = mb_strtolower(($header ?? '') . ' ' . ($title ?? '') . ' ' . ($content ?? '') . ' ' . $rawSvgContent);

    if (str_starts_with($rawSvgContent, 'scene:')) {
        $sceneType = substr($rawSvgContent, 6);
    } elseif (!empty($rawSvgContent) && !str_starts_with($rawSvgContent, '/images/web/') && (str_starts_with($rawSvgContent, '/images/service/') || preg_match('/\.(svg|png|jpe?g|webp|gif)$/i', $rawSvgContent))) {
        $sceneType = $rawSvgContent;
    } elseif (str_contains($combinedText, 'sunat') || str_contains($combinedText, 'representación aduanera')) {
        $sceneType = 'customs';
    } elseif (str_contains($combinedText, 'consultas de comercio exterior') || str_contains($combinedText, 'dudas sobre importación')) {
        $sceneType = 'consulting';
    } elseif (str_contains($combinedText, 'marítim') || str_contains($combinedText, 'fcl') || str_contains($combinedText, 'breakbulk') || str_contains($combinedText, 'logística internacional') || str_contains($combinedText, 'multimodal')) {
        $sceneType = 'ship';
    } elseif (str_contains($combinedText, 'distribu') || str_contains($combinedText, 'fiabilidad') || str_contains($combinedText, 'truck')) {
        $sceneType = 'truck';
    } else {
        $sceneType = 'walkers';
    }
@endphp

<!-- resources/views/components/content-link-section.blade.php -->
<section id="content_link_section" class="scroll-svg-section w-full bg-slate-50 text-slate-900 py-16 sm:py-24 border-b border-slate-200/80" data-scroll-title="{{ $header ?: 'Asesoría' }}">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Left Column: Narrative Content -->
            <div class="lg:col-span-7 flex flex-col items-start">
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

                @if(!empty($content))
                    <p class="text-base sm:text-lg font-normal text-slate-600 leading-relaxed mb-6">
                        {{ $content }}
                    </p>
                @endif

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <a
                        href="{{ $href ?? route('quote') }}"
                        class="taste-btn inline-flex items-center gap-2 h-11 px-6 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm group"
                    >
                        <span>{{ $button ?? 'Obtener Cotización' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a
                        href="{{ route('contact') }}"
                        class="taste-btn inline-flex items-center gap-2 h-11 px-5 rounded-xl border border-slate-300 hover:border-slate-900 bg-white text-slate-700 hover:text-slate-900 font-semibold text-sm"
                    >
                        <span>{{ __('Contactar Asesor') }}</span>
                    </a>
                </div>
            </div>

            <!-- Right Column: Friendly Illustrated Animated SVG Scene -->
            <div class="lg:col-span-5">
                <x-animated-logistics-scene :scene="$sceneType" :title="$title" />
            </div>
        </div>
    </div>
</section>
