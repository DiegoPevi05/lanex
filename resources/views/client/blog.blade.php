@section('title', ($blog->title ?? 'Artículo') . ' | LanEx Blog')
@section('meta_description', !empty($blog->excerpt) ? $blog->excerpt : (!empty($blog->content) ? Str::limit(strip_tags($blog->content), 155) : __('messages.meta.home')))
@section('og_type', 'article')
@if(!empty($blog->image))
@section('og_image', asset('storage/' . $blog->image))
@endif
@extends('layouts.client')

@section('content-client')
    <!-- Editorial Article Header -->
    <section id="blog-hero-section" data-enter class="w-full flex flex-col min-h-[70svh] lg:min-h-[75svh] pt-[160px] xl:pt-[190px] pb-20 relative z-10 text-white overflow-hidden bg-slate-950">
        @if(!empty($blog->featured_image))
            <img src="{{ asset('storage/'. $blog->featured_image) }}" alt="{{ $blog->title }}" class="hero-enter-media w-full h-full absolute inset-0 object-cover opacity-55">
        @elseif(!empty($blog->thumbnail_image))
            <img src="{{ asset('storage/'. $blog->thumbnail_image) }}" alt="{{ $blog->title }}" class="hero-enter-media w-full h-full absolute inset-0 object-cover opacity-55">
        @endif
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-primary-dark/45 z-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary/35 via-transparent to-transparent z-10 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-6 lg:px-8 relative z-20 w-full my-auto flex flex-col justify-center">
            <div class="flex flex-wrap items-center gap-3 mb-4 hero-enter-item">
                <a href="{{ route('blogs') }}" class="taste-btn inline-flex items-center gap-1.5 text-xs font-semibold text-purple-300 hover:text-white bg-white/10 px-3 py-1.5 rounded-lg border border-white/15">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    <span>{{ __('Volver a Noticias') }}</span>
                </a>
                @if(isset($blog->tags) && is_array($blog->tags) && count($blog->tags) > 0)
                    @foreach($blog->tags as $tag)
                        <span class="text-xs font-bold uppercase tracking-wider text-purple-300">{{ ltrim($tag, '#') }}</span>
                    @endforeach
                @endif
            </div>

            <h1 class="hero-enter-item text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight font-display">
                {{ $blog->title }}
            </h1>

            @if(!empty($blog->sub_header))
                <p class="hero-enter-item text-base sm:text-lg text-slate-300 font-normal leading-relaxed mt-4 max-w-3xl">
                    {{ $blog->sub_header }}
                </p>
            @endif

            <div class="hero-enter-item flex flex-wrap items-center gap-6 pt-6 mt-6 border-t border-white/15 text-xs text-slate-300">
                @if(!empty($blog->author))
                    <div>
                        <span class="text-slate-400 block">{{ __('Autor') }}</span>
                        <strong class="text-white font-semibold">{{ $blog->author }}</strong>
                    </div>
                @endif
                @if(!empty($blog->published_at))
                    <div>
                        <span class="text-slate-400 block">{{ __('Fecha de publicación') }}</span>
                        <strong class="text-white font-semibold">{{ \Carbon\Carbon::parse($blog->published_at)->format('d M Y') }}</strong>
                    </div>
                @endif
                @if(!empty($blog->reading_time))
                    <div>
                        <span class="text-slate-400 block">{{ __('Tiempo de lectura') }}</span>
                        <strong class="text-white font-semibold">{{ $blog->reading_time }} minutos</strong>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Editorial Article Body -->
    <section id="blog-content" class="w-full py-16 sm:py-24 bg-white text-slate-800 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                <!-- Main Reading Column -->
                <article class="lg:col-span-8 flex flex-col gap-8">
                    @if(!empty($blog->excerpt))
                        <p class="text-lg sm:text-xl font-medium text-slate-900 leading-relaxed border-l-2 border-primary pl-5">
                            {{ $blog->excerpt }}
                        </p>
                    @endif

                    @if(isset($blog->content) && is_array($blog->content) && count($blog->content) > 0)
                        @foreach($blog->content as $contentItem)
                            <div class="flex flex-col gap-3">
                                @if(!empty($contentItem['header']))
                                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight leading-snug font-display">
                                        {{ $contentItem['header'] }}
                                    </h2>
                                @endif
                                @if(!empty($contentItem['content']))
                                    <p class="text-base text-slate-700 font-normal leading-relaxed">
                                        {{ $contentItem['content'] }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </article>

                <!-- Side Context Column -->
                <aside class="lg:col-span-4 flex flex-col gap-6">
                    @if(!empty($blog->thumbnail_image))
                        <div class="taste-photo-wrap rounded-2xl overflow-hidden border border-slate-200/90 bg-slate-100">
                            <img src="{{ asset('storage/'. $blog->thumbnail_image) }}" alt="{{ $blog->title }}" class="taste-photo-zoom w-full h-56 object-cover object-center">
                        </div>
                    @endif

                    <div class="bg-slate-50 rounded-2xl border border-slate-200/90 p-6 flex flex-col gap-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-primary">{{ __('ASESORÍA EN COMERCIO EXTERIOR') }}</span>
                        <h2 class="text-xl font-bold text-slate-900 tracking-tight leading-snug">
                            {{ __('Planifica tu próximo embarque con LanEx') }}
                        </h2>
                        <p class="text-sm text-slate-600 font-normal leading-relaxed">
                            {{ __('Coordinamos fletes marítimos, aéreos y despacho aduanero desde China y Estados Unidos hacia el Puerto del Callao.') }}
                        </p>
                        <a href="{{ route('quote') }}" class="taste-btn w-full h-11 px-5 rounded-xl bg-primary hover:bg-primary-dark text-white text-xs font-semibold uppercase tracking-wider inline-flex items-center justify-center gap-2">
                            <span>{{ __('Solicitar Cotización') }}</span>
                            <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
