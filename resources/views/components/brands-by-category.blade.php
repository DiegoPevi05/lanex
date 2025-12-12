@php
    // Fallback label for suppliers without category

    $otherCategory = __('messages.suppliers.supplier_section.otherCategory');

    $suppliersCollection = collect($suppliers ?? []);

    $grouped = $suppliersCollection->groupBy(function ($s) use ($otherCategory) {
        $cat = is_string($s->category ?? null) ? trim($s->category) : '';
        return $cat !== '' ? $cat : $otherCategory;
    });

    // Keep categories in a stable order, with "Other category" at the end
    $categories = $grouped->keys()->values()->all();
    usort($categories, function ($a, $b) use ($otherCategory) {
        if ($a === $otherCategory) return 1;
        if ($b === $otherCategory) return -1;
        return strcasecmp($a, $b);
    });

    $defaultCategory = $categories[0] ?? $otherCategory;
@endphp

<section id="brands_by_category" class="w-full bg-secondary px-6 sm:px-24 py-24 flex flex-col justify-center items-center gap-y-10">
    @if(!empty($title))
        <h3 class="text-center font-bold uppercase text-primary-dark">{{ $title }}</h3>
    @endif

    {{-- Category pills (radio buttons) --}}
    <div class="w-full flex flex-wrap justify-center gap-3">
        @foreach($categories as $idx => $cat)
            @php
                $catId = 'brand-cat-' . $idx . '-' . \Illuminate\Support\Str::slug($cat);
                $checked = $cat === $defaultCategory;
            @endphp

            <input
                type="radio"
                name="brandCategory"
                id="{{ $catId }}"
                value="{{ $cat }}"
                class="sr-only peer"
                {{ $checked ? 'checked' : '' }}
            />
            <label
                for="{{ $catId }}"
                data-brand-pill="1"
                class="
                    cursor-pointer select-none
                    px-5 py-2 rounded-full
                    text-sm font-bold
                    border-2 border-primary
                    text-primary
                    bg-white
                    transition duration-300
                    hover:bg-primary hover:text-white
                "
            >
                {{ $cat }}
            </label>
        @endforeach
    </div>

    {{-- Logo panels --}}
    <div class="brand-panels-wrap w-full max-w-6xl">
        @foreach($categories as $idx => $cat)
            @php
                $isActive = $cat === $defaultCategory;
                $items = $grouped->get($cat, collect());
            @endphp

            <div class="brand-panel {{ $isActive ? 'is-active' : 'is-hidden' }}" data-brand-category="{{ $cat }}">
                <div class="w-full flex flex-wrap justify-center gap-x-12 gap-y-10 pt-6">
                    @foreach($items as $supplier)
                        @php
                            $href = !empty($supplier->webpage)
                                ? $supplier->webpage
                                : (function () use ($supplier) {
                                    try { return route('supplier', $supplier->id); }
                                    catch (\Throwable $e) { return '#'; }
                                })();
                        @endphp

                        <a
                            href="{{ $href }}"
                            class="group p-none m-none"
                            target="{{ !empty($supplier->webpage) ? '_blank' : '_self' }}"
                            rel="{{ !empty($supplier->webpage) ? 'noopener noreferrer' : '' }}"
                            aria-label="{{ $supplier->name ?? 'supplier' }}"
                            title="{{ $supplier->name ?? '' }}"
                        >
                            <div
                                class="
                                    brand-logo-item
                                    h-[52px] w-[220px]
                                    flex items-center justify-center
                                    transition duration-300
                                    group-hover:scale-[1.03]
                                "
                            >
                                <img
                                    src="{{ asset('storage/' . $supplier->logo) }}"
                                    alt="brand_logo_{{ $supplier->id }}"
                                    class="max-h-full w-auto object-contain"
                                />
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const radios = Array.from(document.querySelectorAll('input[name="brandCategory"]'));
    const panels = Array.from(document.querySelectorAll(".brand-panel"));

    function setActivePill(input) {
      // reset all labels
      radios.forEach((r) => {
        const label = document.querySelector(`label[for="${r.id}"]`);
        if (!label) return;

        label.classList.remove("bg-primary", "text-white");
        label.classList.add("bg-white", "text-primary");
      });

      // activate selected
      const activeLabel = document.querySelector(`label[for="${input.id}"]`);
      if (activeLabel) {
        activeLabel.classList.remove("bg-white", "text-primary");
        activeLabel.classList.add("bg-primary", "text-white");
      }
    }

    const wrap = document.querySelector(".brand-panels-wrap");
    const DURATION = 280; // must match CSS

    function measureHiddenPanel(panel) {
      if (!panel) return 0;

      // If it's already visible, measure directly
      if (!panel.classList.contains("is-hidden")) return panel.offsetHeight;

      // Temporarily show for measurement without affecting layout
      panel.classList.remove("is-hidden");
      panel.classList.add("is-measuring");
      const h = panel.offsetHeight;
      panel.classList.remove("is-measuring");
      panel.classList.add("is-hidden");

      return h;
    }

    function animateWrapHeight(fromH, toH) {
      if (!wrap) return;

      wrap.style.height = fromH + "px";
      // force reflow
      wrap.offsetHeight;
      wrap.style.height = toH + "px";

      // after animation, let it be auto again
      setTimeout(() => {
        wrap.style.height = "auto";
      }, DURATION);
    }

    function showCategory(cat) {
      const current = panels.find(p => p.classList.contains("is-active"));
      const next = panels.find(p => p.dataset.brandCategory === cat);

      if (!next || current === next) return;

      const currentH = current ? current.offsetHeight : 0;
      const nextH = measureHiddenPanel(next);

      animateWrapHeight(currentH, nextH);

      // Prepare next: add to layout, then animate in
      next.classList.remove("is-hidden", "is-leaving");
      requestAnimationFrame(() => next.classList.add("is-active"));

      // Animate current out, then remove from layout
      if (current) {
        current.classList.remove("is-active");
        current.classList.add("is-leaving");

        setTimeout(() => {
          current.classList.remove("is-leaving");
          current.classList.add("is-hidden");
        }, DURATION);
      }
    }

    function syncUI() {
      const checked = radios.find(r => r.checked) || radios[0];
      if (!checked) return;
      setActivePill(checked);
      showCategory(checked.value);
    }

    // init
    syncUI();

    // on change
    radios.forEach((r) => {
      r.addEventListener("change", () => {
        setActivePill(r);
        showCategory(r.value);
      });
    });
  });
</script>
