<section id="home_blogs" class="home_blogs relative w-full lg:h-[100vh] flex flex-col justify-start items-center pt-24 py-6 lg:py-6 px-12 lg:px-24 bg-white">
            <div class="relative w-full flex flex-row justify-center items-start lg:px-6 z-20">
                <div class="relative h-auto w-full flex flex-col justify-center items-center">
                    <h2 class="font-bold text-primary text-center text-2xl">
                        {{__('messages.home.blogs.title')}}
                    </h2>
                    <h1 class="text-primary-dark font-bold text-center text-xl sm:text-5xl">
                        {{__('messages.home.blogs.subtitle')}}
                    </h1>

                        <div class="carousel-project-images">
                            @foreach($blogs as $index => $blog)
                                <input type="radio" name="position" class="bullet-selector-project opacity-0 pointer-events-none" />
                            @endforeach

                            <main id="carousel">
                                @foreach($blogs as $blog)
                                    <div class="item bg-white border-2 border-gray-200 shadow-md rounded-lg flex flex-col items-start justify-start cursor-pointer group">
                                        <a href="{{ route('blog', $blog->id) }}" class="w-full h-auto">
                                            <div class="w-full h-[150px] overflow-hidden">
                                                <img src="{{ asset('storage/'.$blog->thumbnail_image) }}" alt="icon" class="w-full h-auto object-cover transition-all duration-300 opacity-50 group-hover:opacity-100 group-hover:scale-105" />
                                            </div>
                                        </a>
                                        <div class="w-full h-full flex flex-col items-start justify-start p-2">
                                            <span class="w-full flex flex-row items-center justify-between">
                                                <p class="text-gray-500 text-xs">
                                                    {{ __('messages.home.blogs.published_at') }} <strong>{{ $blog->published_at }}</strong>
                                                </p>
                                                <p class="text-gray-500 text-xs">
                                                    {{ __('messages.home.blogs.reading_time') }} <strong>{{ $blog->reading_time }}</strong> {{ __('messages.home.blogs.minutes') }}
                                                </p>
                                            </span>
                                            <h3 class="font-bold text-primary-dark mt-2 text-xs text-left">
                                                {{ $blog->title }}
                                            </h3>
                                            <p class="text-gray-500 text-xs text-justify pt-2">
                                                {{ \Illuminate\Support\Str::limit($blog->excerpt, 200, '...') }}
                                            </p>

                                            <span class="mt-auto w-full flex flex-row flex-wrap items-center justify-between gap-1 pt-2">

                                                @if(isset($blog->tags) && is_array($blog->tags) && count($blog->tags) > 0)
                                                    @foreach($blog->tags as $tag)
                                                        <p class="bg-primary text-white px-2 py-1 rounded-full text-xs">
                                                            {{ $tag }}
                                                        </p>
                                                    @endforeach
                                                @endif
                                            </span>
                                            <p class="text-gray-500 mt-auto py-4">
                                                {{ __('messages.home.blogs.author') }} <strong>{{ $blog->author }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </main>
                            <span class="hidden lg:block previous_button_span absolute top-1/2 -left-16 h-12 w-12 p-1 bg-primary text-white rounded-full z-10 flex justify-center items-center cursor-pointer hover:bg-secondary hover:text-primary active:scale-95 border-2 border-primary hover:border-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left h-full w-full"><path d="m15 18-6-6 6-6"/></svg>
                            </span>
                            <span class="hidden lg:block next_button_span absolute top-1/2 -right-16 h-12 w-12 p-1 bg-primary text-white rounded-full z-10 flex justify-center items-center cursor-pointer hover:bg-secondary hover:text-primary active:scale-95 border-2 border-primary hover:border-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right h-full w-full"><path d="m9 18 6-6-6-6"/></svg>
                            </span>
                        </div>
                </div>
            </div>
            <ul class="w-full h-auto absolute flex flex-row justify-center items-center gap-x-2 lg:gap-4 bottom-6 sm:bottom-12 z-[50]">
                @foreach($blogs as $index => $blog)
                    <li class="w-6 h-6 bg-white border-2 border-primary hover:bg-primary active:scale-95 rounded-full transition-all duration-300 cursor-pointer bullet_selector"></li>
                @endforeach
            </ul>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Get elements using vanilla JS selectors
            const bulletSelectorProjects = document.querySelectorAll('.home_blogs .bullet-selector-project');
            const bulletSelectors = document.querySelectorAll('.home_blogs .bullet_selector');
            const previousButtonSpan = document.querySelector('.home_blogs .previous_button_span');
            const nextButtonSpan = document.querySelector('.home_blogs .next_button_span');


            //initialize the middle bullet or bullet 2 index with bg-primary
            const getMiddleBullet = Math.floor(bulletSelectors.length / 2);
            bulletSelectors[getMiddleBullet].classList.remove('bg-white');
            bulletSelectors[getMiddleBullet].classList.add('bg-primary');
            bulletSelectorProjects[getMiddleBullet].checked = true;
            // Add click events to bullet selectors
            bulletSelectors.forEach((selector, index) => {
                selector.addEventListener('click', () => {
                    bulletSelectorProjects[index].checked = true;
                    selector.classList.remove('bg-white');
                    selector.classList.add('bg-primary');
                    // Remove class from other selectors
                    bulletSelectors.forEach(otherSelector => {
                        if (otherSelector !== selector) {
                            otherSelector.classList.add('bg-white');
                            otherSelector.classList.remove('bg-primary');
                        }
                    });
                });
            });

            // Previous button click handler
            previousButtonSpan.addEventListener('click', () => {
                let currentIndex = Array.from(bulletSelectorProjects).findIndex(selector => selector.checked);

                // Calculate new index
                let newIndex = currentIndex === 0 ? bulletSelectorProjects.length - 1 : currentIndex - 1;
                // Update radio button and styling
                bulletSelectorProjects[newIndex].checked = true;
                bulletSelectors[newIndex].classList.add('bg-primary');
                bulletSelectors[newIndex].classList.remove('bg-white');
                // Remove styling from other selectors
                bulletSelectors.forEach((selector, index) => {
                    if (index !== newIndex) {
                        selector.classList.add('bg-white');
                        selector.classList.remove('bg-primary');
                    }
                });
            });

            // Next button click handler
            nextButtonSpan.addEventListener('click', () => {
                let currentIndex = Array.from(bulletSelectorProjects).findIndex(selector => selector.checked);

                // Calculate new index
                let newIndex = currentIndex === bulletSelectorProjects.length - 1 ? 0 : currentIndex + 1;

                // Update radio button and styling
                bulletSelectorProjects[newIndex].checked = true;
                bulletSelectors[newIndex].classList.add('bg-primary');
                bulletSelectors[newIndex].classList.remove('bg-white');

                // Remove styling from other selectors
                bulletSelectors.forEach((selector, index) => {
                    if (index !== newIndex) {
                        selector.classList.add('bg-white');
                        selector.classList.remove('bg-primary');
                    }
                });
            });

        });

    </script>
