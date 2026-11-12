<section id="brands" class="w-full bg-slate-50 border-b border-slate-200/80 py-12 sm:py-14">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col gap-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <span class="text-xs font-bold uppercase tracking-widest text-primary block">
                {{ $title ?: 'Compañías Asociadas' }}
            </span>
            <span class="text-xs text-slate-500 font-normal">{{ __('Fabricantes y operadores certificados') }}</span>
        </div>

        <div class="w-full grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3.5">
            @foreach (collect($suppliers ?? [])->take(6) as $supplier)
                <a href="{{ route('supplier', $supplier['id']) }}" class="taste-card-link group bg-white border border-slate-200/90 hover:border-primary/50 rounded-xl p-4 h-20 flex items-center justify-center hover:shadow-xs">
                    <img src="{{ asset('storage/' . $supplier->logo) }}" alt="{{ $supplier->name ?? 'Marca asociada' }}" class="taste-photo-zoom max-h-9 w-auto max-w-[120px] object-contain opacity-90 group-hover:opacity-100" loading="lazy" />
                </a>
            @endforeach
        </div>
    </div>
</section>
