@section('meta_description', __('messages.meta.home'))
@extends('layouts.client')

@section('content-client')
    <section id="blog-hero-section" class="w-full flex flex-col h-screen pt-[80px] xl:pt-[140px] relative z-10 text-white">

        <img src="{{ asset('storage/'. 'images/web/cosco.webp')}}" alt="suppliers_hero_image" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 object-cover  z-20 blur-sm">
        <div class="w-full h-[calc(100vh-80px)] xl:h-[calc(100vh-140px)] padding-x padding-b z-30">
            <div class="w-full h-full flex flex-col justify-center gap-y-12 animation-group">

                <div class="w-full h-auto flex flex-col justify-center items-center gap-y-4 animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-col gap-y-2 justify-center items-start lg:items-center">
                        <h5 class="font-bold text-left lg:text-center text-3xl">{{ __('messages.blogs.hero.header') }}</h5>
                        <h1 class="font-bold text-left lg:text-center text-5xl">{{ __('messages.blogs.hero.title') }}</h1>
                    </div>
                </div>
                <div class="w-full h-auto flex flex-col items-start justify-start text-body gap-y-1 bg-primary-dark sm:bg-white p-3 sm:p-6 rounded-xl animation-element slide-in-up" >
                    <div class="w-full flex flex-col sm:flex-row items-end sm:items-center justify-start gap-y-4 sm:gap-x-4">
                        <input
                            id="blogNameInput"
                            placeholder="{{ __('messages.blogs.hero.input_placeholder') }}" class="uppercase w-full border-2 border-body rounded-md p-4 text-md font-bold focus:border-2 focus:border-primary focus:outline-none" />
                        <button
                        id="searchButton"
                        class="h-full uppercase font-bold rounded-xl active:scale-95 duration-300 hover:bg-primary-dark bg-primary text-white p-4 rounded-md">
                        {{ __('messages.suppliers.hero.input_button') }}
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="blogs-sections" class="relative w-full h-full padding flex flex-col justify-center items-center">
        <h5 class="animation-element slide-in-up text-primary">{{ __('messages.blogs.blogs_section.header') }}</h5>
        <h1 class="font-bold text-primary-dark animation-element slide-in-up text-center">
            {{ __('messages.blogs.blogs_section.title') }}
        </h1>

        <div class="w-full h-auto min-h-[400px] py-12 xl:p-12 flex flex-col justify-center items-center duration-300 transition-all">
            <div id="blogs-items" class="h-full w-full grid grid-cols-3 sm:grid-cols-4 xl:grid-cols-3 gap-6 xl:gap-24 animation-element slide-in-down">


            </div>
            <div id="loader-blogs-content" class="w-full h-auto flex justify-center items-center animate-spin text-primary hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 sm:h-20 w-10 sm:w-20 lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
            </div>
            <div id="empty-blogs-content" class="w-full h-auto flex flex-col items-center justify-center gap-y-12 animation-element slide-in-down hidden">
                <h5 class="font-bold text-primary">{{__('messages.blogs.blogs_section.empty_content')}}</h5>
                <img src="{{ asset('storage/' . '/images/web/empty.svg' ) }}" class="h-24 sm:h-48 w-auto"/>
            </div>
        </div>

        <div class="w-full h-auto flex flex-row justify-around">
            <div class="flex flex-row w-auto h-auto justify-center items-center gap-x-4">
                <!-- First Page -->
                <button
                   id="first-blogs-page"
                   class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white text-white bg-primary hover:bg-white hover:text-primary border-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-left">
                        <path d="m11 17-5-5 5-5"></path><path d="m18 17-5-5 5-5"></path>
                    </svg>
                </button>
                <!-- Previous Page -->
                <button
                   id="prev-blogs-page"
                   class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white text-white bg-primary hover:bg-white hover:text-primary border-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </button>
            </div>
            <div class="flex flex-row w-auto h-auto justify-center items-center gap-x-4">
                <!-- Next Page -->
                <button
                   id="next-blogs-page"
                   class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white text-white bg-primary hover:bg-white hover:text-primary border-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
                <!-- Last Page -->
                <button

                   id="last-blogs-page"
                   class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white text-white bg-primary hover:bg-white hover:text-primary border-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-right">
                        <path d="m6 17 5-5-5-5"></path><path d="m13 17 5-5-5-5"></path>
                    </svg>
                </button>
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
                    const blogDiv = document.createElement('div');
                    blogDiv.classList.add('col-span-3', 'sm:col-span-2', 'xl:col-span-1', 'min-h-[400px]','bg-white', 'border-2', 'border-gray-200', 'shadow-md', 'rounded-lg', 'flex', 'flex-col', 'items-start', 'justify-start', 'cursor-pointer', 'group');

                    blogDiv.innerHTML = `
                        <a href="/blog/${blog.id}" class="w-full h-auto">
                            <div class="w-full h-[150px] overflow-hidden">
                                <img src="/storage/${blog.thumbnail_image}" alt="icon" class="w-full h-auto object-cover transition-all duration-300 opacity-50 group-hover:opacity-100 group-hover:scale-105" />
                            </div>
                        </a>
                        <div class="w-full h-full flex flex-col items-start justify-start p-2">
                            <span class="w-full flex flex-row items-center justify-between">
                                <p class="text-gray-500 text-xs">
                                    {{ __('messages.home.blogs.published_at') }} <strong>${blog.published_at}</strong>
                                </p>
                                <p class="text-gray-500 text-xs">
                                    {{ __('messages.home.blogs.reading_time') }} <strong>${blog.reading_time}</strong> {{ __('messages.home.blogs.minutes') }}
                                </p>
                            </span>
                            <h3 class="font-bold text-primary-dark mt-2">
                                ${blog.title}
                            </h3>
                            <p class="text-gray-500">
                                ${blog.excerpt}
                            </p>
                            
                            <span class="w-full flex flex-row flex-wrap items-center justify-between">
                                ${blog.tags.map(tag => `<p class="text-gray-500">${tag}</p>`).join('')}
                            </span>
                            <p class="text-gray-500 mt-auto">
                                {{ __('messages.home.blogs.author') }} <strong>${blog.author}</strong> 
                            </p>
                        </div>
                    `;

                    blogsContainer.appendChild(blogDiv);
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
