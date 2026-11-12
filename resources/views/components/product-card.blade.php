<div id="product_card_{{$product['id']}}" class="taste-card-link w-full h-full bg-white rounded-2xl border border-slate-200/90 hover:border-primary/50 hover:shadow-md p-6 flex flex-col justify-between text-slate-900 group">
    <div>
        <div class="w-28 h-28 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-2 mb-4 mx-auto overflow-hidden">
            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" class="taste-photo-zoom max-w-full max-h-full object-contain" />
        </div>

        <div class="flex items-center justify-center gap-1 text-amber-400 mb-2">
            @for ($i = 0; $i < ($product['stars'] ?? 5); $i++)
                <x-heroicon-s-star class="w-4 h-4 text-amber-400 fill-current" />
            @endfor
        </div>

        <p class="font-bold text-slate-900 text-center text-base leading-snug mb-2 font-display">
            {{ $product['name'] }}
        </p>

        <p class="text-sm text-slate-600 text-center line-clamp-3 leading-relaxed font-normal">
            {{ $product['description'] }}
        </p>
    </div>

    <div class="w-full pt-4 mt-3 border-t border-slate-100">
        <a href="{{ route('quote') . '?type=product&id=' . $product['id'] }}" class="taste-btn w-full h-11 px-4 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-xs tracking-wider text-center uppercase flex items-center justify-center gap-2">
            <span>{{ __('Cotizar Producto') }}</span>
            <svg class="w-3.5 h-3.5 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </a>
    </div>
</div>
