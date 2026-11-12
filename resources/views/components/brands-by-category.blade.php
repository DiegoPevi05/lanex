@php
    $suppliersCollection = collect($suppliers ?? []);

    $categories = $suppliersCollection->pluck('category')->filter()->unique()->values()->all();
    sort($categories);
@endphp

<section id="brands_by_category" class="w-full bg-white py-16 sm:py-20 border-b border-slate-200/80 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col items-center gap-y-8">
        <!-- Centered Section Header -->
        <div class="max-w-3xl mx-auto text-center flex flex-col items-center gap-2.5">
            <span class="text-xs font-bold uppercase tracking-widest text-primary block">
                {{ __('RED DE PROVEEDORES VERIFICADOS') }}
            </span>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
                {{ $title ?: __('Compañías con las que Trabajamos') }}
            </h2>
            <p class="text-slate-600 text-base font-normal leading-relaxed">
                {{ __('Conectamos directamente con fabricantes certificados y marcas líderes en China, Estados Unidos y la región para compras seguras y despachos consolidados.') }}
            </p>
        </div>

        <!-- Centered Category Filter Tabs -->
        @if(count($categories) > 0)
            <div class="w-full flex flex-wrap items-center justify-center gap-2.5">
                <button
                    type="button"
                    class="supplier-cat-btn h-11 px-5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-150 bg-primary text-white shadow-xs cursor-pointer"
                    data-cat="all"
                >
                    {{ __('Todos') }} ({{ $suppliersCollection->count() }})
                </button>
                @foreach($categories as $cat)
                    @php
                        $count = $suppliersCollection->where('category', $cat)->count();
                    @endphp
                    <button
                        type="button"
                        class="supplier-cat-btn h-11 px-5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-150 bg-slate-100 text-slate-700 hover:text-slate-900 hover:bg-slate-200/70 cursor-pointer"
                        data-cat="{{ \Illuminate\Support\Str::slug($cat) }}"
                    >
                        {{ $cat }} ({{ $count }})
                    </button>
                @endforeach
            </div>

            <!-- Filtered Brand Cards Grid -->
            <div class="w-full grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 pt-2" id="supplier-cards-grid">
                @foreach($suppliersCollection as $supplier)
                    @php
                        $catSlug = \Illuminate\Support\Str::slug($supplier->category ?? 'other');
                        $href = !empty($supplier->webpage)
                            ? $supplier->webpage
                            : (function () use ($supplier) {
                                try { return route('supplier', $supplier->id); }
                                catch (\Throwable $e) { return '#'; }
                            })();
                    @endphp

                    <a
                        href="{{ $href }}"
                        class="supplier-brand-card taste-card-link group bg-slate-50/70 hover:bg-white border border-slate-200/90 hover:border-primary/50 rounded-xl p-4 h-24 flex items-center justify-center hover:shadow-sm cursor-pointer"
                        data-category="{{ $catSlug }}"
                        target="{{ !empty($supplier->webpage) ? '_blank' : '_self' }}"
                        rel="{{ !empty($supplier->webpage) ? 'noopener noreferrer' : '' }}"
                        aria-label="{{ $supplier->name }}"
                        title="{{ $supplier->name }} - {{ $supplier->category }}"
                    >
                        <img
                            src="{{ asset('storage/' . $supplier->logo) }}"
                            alt="{{ $supplier->name ?? 'brand' }}"
                            class="taste-photo-zoom max-h-10 w-auto max-w-[130px] object-contain opacity-90 group-hover:opacity-100"
                            loading="lazy"
                        />
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const catButtons = document.querySelectorAll('.supplier-cat-btn');
        const cards = document.querySelectorAll('.supplier-brand-card');

        catButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const targetCat = this.getAttribute('data-cat');

                // Update active tab style
                catButtons.forEach(b => {
                    b.classList.remove('bg-primary', 'text-white', 'shadow-xs');
                    b.classList.add('bg-slate-100', 'text-slate-700');
                });
                this.classList.remove('bg-slate-100', 'text-slate-700');
                this.classList.add('bg-primary', 'text-white', 'shadow-xs');

                // Filter cards smoothly
                cards.forEach(card => {
                    const cardCat = card.getAttribute('data-category');
                    if (targetCat === 'all' || cardCat === targetCat) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
