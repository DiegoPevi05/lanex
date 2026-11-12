<!-- resources/views/components/blogs-carousel.blade.php -->
<section id="home_blogs" class="w-full bg-slate-50/50 py-12 sm:py-16 border-b border-slate-200/80 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col gap-8">
        <!-- Header with Integrated Nav Controls -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="flex flex-col gap-1.5 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-widest text-primary block">
                    {{ __('NOTICIAS & COMERCIO EXTERIOR') }}
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
                    {{ __('messages.home.blogs.title') }}
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm font-normal leading-relaxed">
                    {{ __('Actualizaciones aduaneras, guías de importación y análisis del comercio internacional.') }}
                </p>
            </div>

            <!-- Carousel Controls -->
            <div class="flex items-center gap-2 self-start sm:self-auto shrink-0">
                <button
                    type="button"
                    id="blog_carousel_prev"
                    aria-label="{{ __('Noticia anterior') }}"
                    class="taste-btn h-11 w-11 rounded-xl bg-white border border-slate-200 hover:border-slate-300 text-slate-700 hover:text-white hover:bg-slate-900 flex items-center justify-center cursor-pointer"
                >
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
                </button>
                <button
                    type="button"
                    id="blog_carousel_next"
                    aria-label="{{ __('Noticia siguiente') }}"
                    class="taste-btn h-11 w-11 rounded-xl bg-white border border-slate-200 hover:border-slate-300 text-slate-700 hover:text-white hover:bg-slate-900 flex items-center justify-center cursor-pointer"
                >
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                </button>
            </div>
        </div>

        <!-- Slider Viewport -->
        <div class="w-full relative overflow-hidden" id="blog_slider_viewport">
            <div
                id="blog_slider_track"
                class="blog-slider-track flex gap-5 py-2"
                style="transform: translateX(0px);"
            >
                @foreach($blogs as $index => $blog)
                    @php
                        $tags = is_array($blog->tags) ? $blog->tags : (json_decode($blog->tags, true) ?? []);
                        $firstTag = !empty($tags) ? ltrim($tags[0], '#') : 'Comercio Exterior';
                        $pubDate = $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d M Y') : 'Reciente';
                    @endphp

                    <article
                        class="blog-card-item taste-card-link flex-shrink-0 w-[285px] sm:w-[330px] bg-white border border-slate-200/90 hover:border-primary/50 rounded-xl overflow-hidden hover:shadow-md flex flex-col justify-between group cursor-pointer"
                        data-index="{{ $index }}"
                    >
                        <!-- Card Image -->
                        <a href="{{ route('blog', $blog->id) }}" class="block relative w-full h-[155px] overflow-hidden bg-slate-100">
                            <img
                                src="{{ asset('storage/' . $blog->thumbnail_image) }}"
                                alt="{{ $blog->title }}"
                                class="taste-photo-zoom w-full h-full object-cover"
                                loading="lazy"
                            />
                            <div class="absolute top-2.5 left-2.5 bg-slate-900/85 text-white text-[10px] font-semibold px-2.5 py-0.5 rounded-md">
                                {{ $firstTag }}
                            </div>
                        </a>

                        <!-- Card Body -->
                        <div class="p-5 flex-1 flex flex-col justify-between gap-3">
                            <div class="flex flex-col gap-1.5">
                                <div class="flex items-center justify-between text-[11px] text-slate-400 font-normal">
                                    <span>{{ $pubDate }}</span>
                                    <span>{{ $blog->reading_time ?? 4 }} min lectura</span>
                                </div>

                                <h3 class="font-bold text-slate-900 group-hover:text-primary text-base leading-snug line-clamp-2 transition-colors">
                                    <a href="{{ route('blog', $blog->id) }}">
                                        {{ $blog->title }}
                                    </a>
                                </h3>

                                <p class="text-sm text-slate-600 font-normal leading-relaxed line-clamp-2">
                                    {{ \Illuminate\Support\Str::limit($blog->excerpt, 120, '...') }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                <span class="text-slate-400 text-[11px] font-normal truncate max-w-[170px]">
                                    {{ $blog->author }}
                                </span>
                                <span class="font-bold text-primary inline-flex items-center gap-1">
                                    <span>{{ __('Leer artículo') }}</span>
                                    <svg class="w-3.5 h-3.5 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Dot Indicators -->
        <div class="flex items-center justify-center gap-1.5" id="blog_slider_dots">
            @foreach($blogs as $index => $blog)
                <button
                    type="button"
                    class="blog-dot h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'w-6 bg-primary' : 'w-2 bg-slate-300 hover:bg-slate-400' }}"
                    data-dot-index="{{ $index }}"
                    aria-label="Ir a noticia {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const track = document.getElementById("blog_slider_track");
        const viewport = document.getElementById("blog_slider_viewport");
        const prevBtn = document.getElementById("blog_carousel_prev");
        const nextBtn = document.getElementById("blog_carousel_next");
        const dots = document.querySelectorAll(".blog-dot");
        const cards = document.querySelectorAll(".blog-card-item");

        if (!track || !cards.length) return;

        let currentIndex = 0;
        const totalCards = cards.length;

        function getCardWidth() {
            const firstCard = cards[0];
            const gap = 20;
            return (firstCard ? firstCard.offsetWidth : 320) + gap;
        }

        function getMaxIndex() {
            if (!viewport || !cards[0]) return totalCards - 1;
            const viewportWidth = viewport.offsetWidth;
            const visibleCount = Math.floor(viewportWidth / (cards[0].offsetWidth + 10)) || 1;
            return Math.max(0, totalCards - visibleCount);
        }

        function updateSlider(index) {
            const maxIdx = getMaxIndex();
            currentIndex = Math.max(0, Math.min(index, maxIdx));
            const cardW = getCardWidth();
            const offset = currentIndex * cardW;

            track.style.transform = `translateX(-${offset}px)`;

            dots.forEach((dot, idx) => {
                if (idx === currentIndex) {
                    dot.classList.remove("w-2", "bg-slate-300");
                    dot.classList.add("w-6", "bg-primary");
                } else {
                    dot.classList.remove("w-6", "bg-primary");
                    dot.classList.add("w-2", "bg-slate-300");
                }
            });
        }

        function nextSlide() {
            const maxIdx = getMaxIndex();
            if (currentIndex >= maxIdx) {
                updateSlider(0);
            } else {
                updateSlider(currentIndex + 1);
            }
        }

        function prevSlide() {
            const maxIdx = getMaxIndex();
            if (currentIndex <= 0) {
                updateSlider(maxIdx);
            } else {
                updateSlider(currentIndex - 1);
            }
        }

        if (nextBtn) nextBtn.addEventListener("click", nextSlide);
        if (prevBtn) prevBtn.addEventListener("click", prevSlide);

        dots.forEach(dot => {
            dot.addEventListener("click", function () {
                const idx = parseInt(this.getAttribute("data-dot-index"), 10);
                updateSlider(idx);
            });
        });

        let startX = 0;
        let isTouching = false;

        viewport.addEventListener("touchstart", (e) => {
            startX = e.touches[0].clientX;
            isTouching = true;
        }, { passive: true });

        viewport.addEventListener("touchend", (e) => {
            if (!isTouching) return;
            const endX = e.changedTouches[0].clientX;
            const diffX = startX - endX;
            if (Math.abs(diffX) > 40) {
                if (diffX > 0) nextSlide();
                else prevSlide();
            }
            isTouching = false;
        }, { passive: true });

        window.addEventListener("resize", () => {
            updateSlider(currentIndex);
        });
    });
</script>
