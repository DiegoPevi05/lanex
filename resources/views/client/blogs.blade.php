@section('title', 'Blog de Logística, Aduanas y Comercio Exterior | LanEx')
@section('meta_description', 'Artículos, guías sobre Incoterms, despacho aduanero, fletes marítimos y aéreos, y tendencias del comercio internacional.')
@extends('layouts.client')

@section('content-client')
    <section id="blog-hero-section" data-enter class="w-full flex flex-col min-h-[75svh] lg:min-h-[82svh] pt-[160px] xl:pt-[190px] pb-24 relative z-10 text-white overflow-hidden bg-slate-950">
        <!-- Photographic Ground with High Visibility -->
        <img src="{{ asset('storage/images/web/cosco.webp') }}" alt="{{ __('Noticias & Blog LanEx') }}" class="hero-enter-media w-full h-full absolute inset-0 object-cover opacity-55">
        <!-- Protective Dark Gradient Overlays for Guaranteed Text Legibility -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-primary-dark/45 z-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary/35 via-transparent to-transparent z-10 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-6 lg:px-8 relative z-20 w-full my-auto flex flex-col justify-center items-center text-center">
            <span class="hero-enter-item text-xs sm:text-sm font-bold uppercase tracking-widest text-purple-400 block mb-3">
                {{ __('NOTICIAS Y ANÁLISIS DE COMERCIO EXTERIOR') }}
            </span>
            <h1 class="hero-enter-item text-3xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight sm:leading-none font-display mb-4">
                {{ __('messages.blogs.blogs_section.title') }}
            </h1>
            <p class="hero-enter-item text-base sm:text-lg text-slate-300 font-normal leading-relaxed max-w-2xl mb-8">
                {{ __('Actualizaciones del Puerto de Chancay y Callao, tendencias logísticas en China y Estados Unidos y normativas SUNAT.') }}
            </p>

            <div class="hero-enter-item w-full max-w-2xl bg-white p-2 sm:p-2.5 rounded-2xl shadow-xl border border-slate-200 text-left">
                <label for="blogNameInput" class="sr-only">{{ __('Buscar artículos de comercio exterior') }}</label>
                <div class="w-full flex flex-col sm:flex-row items-center gap-2">
                    <div class="relative w-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400 absolute left-3.5 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <input
                            id="blogNameInput"
                            placeholder="{{ __('messages.blogs.hero.input_placeholder') }}"
                            class="w-full pl-11 pr-4 h-11 rounded-xl border border-slate-200 text-slate-900 text-base font-medium focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                        />
                    </div>
                    <button
                        id="searchButton"
                        class="taste-btn w-full sm:w-auto px-6 h-11 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm shrink-0 cursor-pointer"
                    >
                        {{ __('messages.suppliers.hero.input_button') }}
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section id="blogs-sections" class="relative w-full h-auto py-16 sm:py-24 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col">
            <div class="max-w-2xl mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-2">{{ __('messages.blogs.blogs_section.header') }}</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight font-display">
                    {{ __('messages.blogs.blogs_section.title') }}
                </h2>
            </div>

            <div class="w-full h-auto min-h-[380px] pb-10 flex flex-col justify-center items-center">
                <div id="blogs-items" class="h-full w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                </div>
                <div id="loader-blogs-content" class="w-full h-auto flex justify-center items-center animate-spin text-primary hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-12 w-12 lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </div>
                <div id="empty-blogs-content" class="w-full h-auto flex flex-col items-center justify-center gap-y-6 hidden">
                    <p class="font-bold text-slate-700 text-lg">{{__('messages.blogs.blogs_section.empty_content')}}</p>
                    <img src="{{ asset('storage/' . '/images/web/empty.svg' ) }}" alt="{{ __('Sin artículos') }}" class="h-28 w-auto"/>
                </div>
            </div>

            <div class="w-full flex flex-row justify-between items-center pt-6 border-t border-slate-200/80">
                <div class="flex flex-row items-center gap-x-3">
                    <button id="first-blogs-page" aria-label="{{ __('Primera página de noticias') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17-5-5 5-5"></path><path d="m18 17-5-5 5-5"></path></svg>
                    </button>
                    <button id="prev-blogs-page" aria-label="{{ __('Página anterior de noticias') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg>
                    </button>
                </div>
                <div class="flex flex-row items-center gap-x-3">
                    <button id="next-blogs-page" aria-label="{{ __('Página siguiente de noticias') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"></path></svg>
                    </button>
                    <button id="last-blogs-page" aria-label="{{ __('Última página de noticias') }}" class="taste-btn h-11 w-11 rounded-xl inline-flex justify-center items-center border text-white bg-primary hover:bg-primary-dark border-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 17 5-5-5-5"></path><path d="m13 17 5-5-5-5"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const blogsSections = document.getElementById('blogs-sections');
        const blogsContainer = document.getElementById('blogs-items');
        const loaderBlogsContent = document.getElementById('loader-blogs-content');

        const firstBlogPageBtn = document.getElementById('first-blogs-page');
        const prevBlogPageBtn = document.getElementById('prev-blogs-page');
        const nextBlogPageBtn = document.getElementById('next-blogs-page');
        const lastBlogPageBtn = document.getElementById('last-blogs-page');
        const searchBlogBtn = document.getElementById('searchButton');
        const searchBlogInput = document.getElementById('blogNameInput');

        const emptyBlogsContent = document.getElementById('empty-blogs-content')

        let currentBlogPage = 1;
        let lastBlogPage = 1;
        // Function to fetch and render suppliers
        async function fetchBlogs(page = 1, blogName = '') {
            blogsContainer.classList.add('hidden');
            loaderBlogsContent.classList.remove('hidden');
            emptyBlogsContent.classList.add('hidden');

            try {
                // Fetch data from the API
                const response = await fetch(`/blogs/api?page_blogs=${page}&blog_content=${blogName}`);
                const data = await response.json();

                // Clear existing blogs
                blogsContainer.innerHTML = '';

                // Update pagination buttons
                currentBlogPage = data.blogs.current_page;
                lastBlogPage = data.blogs.last_page;

                toggleDisableButton(firstBlogPageBtn,currentBlogPage === 1);
                toggleDisableButton(prevBlogPageBtn,currentBlogPage === 1);
                toggleDisableButton(nextBlogPageBtn,currentBlogPage === data.blogs.last_page);
                toggleDisableButton(lastBlogPageBtn,currentBlogPage === data.blogs.last_page);

                if (data.blogs.data.length === 0) {
                    emptyBlogsContent.classList.remove('hidden');
                    loaderBlogsContent.classList.add('hidden');
                    return;
                }

                // Populate blogs
                data.blogs.data.forEach(blog => {
                    const blogCard = document.createElement('article');
                    blogCard.classList.add(
                        'taste-card-link', 'group', 'bg-white', 'border', 'border-slate-200/90', 'hover:border-primary/50',
                        'rounded-2xl', 'overflow-hidden', 'hover:shadow-md', 'flex', 'flex-col', 'justify-between'
                    );

                    const tagsList = Array.isArray(blog.tags) ? blog.tags : [];
                    const firstTag = tagsList.length > 0 ? String(tagsList[0]).replace(/^#/, '') : 'Comercio Exterior';

                    blogCard.innerHTML = `
                        <div>
                            <a href="/blog/${blog.id}" class="block relative w-full h-48 overflow-hidden bg-slate-100">
                                <img src="/storage/${blog.thumbnail_image}" alt="${blog.title}" class="taste-photo-zoom w-full h-full object-cover" />
                                <span class="absolute top-3 left-3 bg-slate-900/85 text-white text-[10px] font-semibold px-2.5 py-1 rounded-md">${firstTag}</span>
                            </a>
                            <div class="p-6 flex flex-col gap-2">
                                <div class="flex items-center justify-between text-xs text-slate-400">
                                    <span>${blog.published_at || ''}</span>
                                    <span>${blog.reading_time || 4} min lectura</span>
                                </div>
                                <h3 class="font-bold text-slate-900 group-hover:text-primary text-lg leading-snug transition-colors mt-1">
                                    <a href="/blog/${blog.id}">${blog.title}</a>
                                </h3>
                                <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mt-1">
                                    ${blog.excerpt || ''}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-500 font-medium truncate max-w-[180px]">${blog.author || 'Equipo LanEx'}</span>
                            <a href="/blog/${blog.id}" class="font-bold text-primary inline-flex items-center gap-1">
                                <span>Leer artículo</span>
                                <svg class="w-3.5 h-3.5 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    `;

                    blogsContainer.appendChild(blogCard);
                });

                blogsContainer.classList.remove('hidden');
            } catch (error) {
                console.error('Error fetching blogs:', error);
                emptyBlogsContent.classList.remove('hidden');
            }finally{
                loaderBlogsContent.classList.add('hidden');
            }

        }

        function toggleDisableButton(button,disable){
            if(disable){
                button.classList.add('bg-gray-300','pointer-events-none','border-gray-200','text-gray-200')
                button.classList.remove('text-white','bg-primary','hover:bg-white','hover:text-primary','border-primary')
            }else{
                button.classList.remove('bg-gray-300','pointer-events-none','border-gray-200','text-gray-200')
                button.classList.add('text-white','bg-primary','hover:bg-white','hover:text-primary','border-primary')
            }
        }

        function scrollToBlogsSections() {
            blogsSections.scrollIntoView({ behavior: 'smooth' });
        }

        function handleBlogSearch(){
            if(searchBlogInput.value && searchBlogInput.value.length != 0){
                fetchBlogs(1,searchBlogInput.value);
                scrollToBlogsSections();
            }else{
                fetchBlogs(1);
                scrollToBlogsSections();
            }
        }

        searchBlogBtn.addEventListener('click', handleBlogSearch);

        searchBlogInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                handleBlogSearch();
            }
        });

        firstBlogPageBtn.addEventListener('click',()=> {
            fetchBlogs(1);
            scrollToBlogsSections();
        })
        // Event listeners for pagination
        prevBlogPageBtn.addEventListener('click', () => {
            if (currentBlogPage > 1) {
                fetchBlogs(currentBlogPage - 1);
            }
            scrollToBlogsSections();
        });

        nextBlogPageBtn.addEventListener('click', () => {
            fetchBlogs(currentBlogPage + 1);
            scrollToBlogsSections();
        });

        lastBlogPageBtn.addEventListener('click',()=>{
            fetchBlogs(lastBlogPage);
            scrollToBlogsSections();
        });


        // Initial load
        fetchBlogs();
    });
</script>
@endpush
