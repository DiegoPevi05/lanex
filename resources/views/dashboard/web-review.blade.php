@extends('layouts.dashboard')

@section('content-dashboard')

    <section id="dashboard_web_review" class="bg-gray-light h-full w-full flex flex-row xl:gap-x-4 p-4">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="w-full h-full flex flex-col bg-white rounded-xl p-4 gap-y-2">
            <div class="w-full h-auto flex flex-row justify-between py-4">
                <div class="w-auto h-auto flex flex-row items-center gap-x-2">
                    <a href="{{ route('dashboard_web') }}" class="h-10 w-10 bg-transparent bg-white rounded-full hover:bg-primary hover:text-white cursor-pointer border-2 border-primary active:scale-95 flex items-center justify-center text-secondary-dark p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                    <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </span>
                    <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.web.review.header') }}</h4>
                </div>

                <div class="w-auto h-auto flex flex-row">
                    <button id="create_button" class="w-auto h-full px-4 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2">
                        {{__('messages.dashboard.web.review.new_review')}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    </button>
                </div>
            </div>

            <x-search-bar
                id='web-content-review-search'
                dropDownId="dashboard-web-review-search-bar"
                :currentDropDownOption="$currentFilter"
                :dropDownOptions="$filters"
                placeholderInput='messages.dashboard.web.review.input_placeholder_search'
                labelButton='messages.dashboard.web.review.button_label_search'
            />
            <div class="w-full flex flex-col overflow-y-scroll no-scroll-bar">
                <div class="w-full flex flex-col gap-y-2 animation-group">
                    @foreach ($pagination->items() as $paginate)
                        <x-web-content-card
                            :data="$paginate"
                        />
                    @endforeach
                </div>
            </div>
            <div class="w-full h-auto flex flex-row justify-between mt-auto">
                <div class="w-auto flex flex-row gap-x-1">
                    <a href="{{route('dashboard_web_review',['page' => 1 ] )}}" class="{{$pagination['currentPage'] == 0 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center   duration-300 cursor-pointer  p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                    </a>

                    <a href="{{ route('dashboard_web_review', ['page' =>$pagination['currentPage'] - 1]) }}" class="{{$pagination['currentPage'] == 0 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                </div>

                <div class="w-auto flex flex-row gap-x-1">
                    <a  href="{{ route('dashboard_web_review', ['page' =>$pagination['currentPage'] + 1]) }}" class="{{$pagination['lastPage'] == $pagination['currentPage'] ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full"><path d="m9 18 6-6-6-6"/></svg>
                    </a>

                    <a href="{{ route('dashboard_web_review', ['page' =>$pagination['lastPage']]) }}" class="{{$pagination['lastPage'] == $pagination['currentPage'] ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="dashboard_web_content_form max-xl:fixed max-xl:top-0 max-xl:bottom-0 max-sm:-right-[100%] max-xl:-right-[600px] w-full  sm:w-[600px] max-xl:border-s-2 xl:w-[40%] h-full bg-white rounded-xl flex flex-col items-center justify-center p-4 transition-all duration-300">
            <div class="w-full h-auto flex flex-row justify-end px-4 xl:hidden absolute top-4 right-0">
                <span class="dashboard_button_toggle_content h-12 w-12 flex items-center justify-center border-2 border-gray-light rounded-xl cursor-pointer hover:bg-primary-dark text-white bg-secondary-dark duration-300 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </span>
            </div>
            <div id="empty-content-form" class="w-auto h-auto flex flex-col items-center justify-center">
                <img src="/images/svg/empty.svg" class="w-[40%] h-auto"/>
                <label>{{__('messages.dashboard.web.empty_content')}}</label>
            </div>
            <div id="loading-content-form" class="hidden w-full h-full flex items-center justify-center">
                <span class="animate-spin p-1 h-12 w-12 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </span>
            </div>
            <div id="content-form" class="hidden h-full w-full">
            </div>
        </div>
        </div>
    </section>
@endsection

<script>


    document.addEventListener("DOMContentLoaded", function() {

        function toggleFormContent(){

            const menu = document.querySelector('.dashboard_web_content_form');

            if (menu.classList.contains('max-xl:-right-[600px]')) {
                menu.classList.add('max-xl:-right-0');
                menu.classList.remove('max-xl:-right-[600px]');
                menu.classList.remove('max-sm:-right-[100%]');

            } else {
                menu.classList.add('max-xl:-right-[600px]');
                menu.classList.add('max-sm:-right-[100%]');
                menu.classList.remove('max-xl:-right-0');
            }

        };

        // Select the button and the menu
        const menuButtons = document.querySelectorAll('.dashboard_button_toggle_content');
        menuButtons.forEach(function(button) {
            button.addEventListener('click', toggleFormContent);
        });



        const SearchBar = document.querySelector(`#web-content-review-search`);
        // Listen for the custom event
        SearchBar.addEventListener('search-web-content-review-search', function (e) {

            const key = e.detail.key; // Get the selected value
            const value = e.detail.value; // Get the selected value
            // Construct the new route
            const newRoute = `/dashboard/web/review?page=1&filterKey=${key}&filterValue=${value}`;

            // Navigate to the new route
            window.location.href = newRoute;
        });





        function updateFormState(content,type){

            toggleFormContent();

            const currentPage = document.querySelector('#dashboard_web_review');
            const contentForm  = currentPage.querySelector('#content-form');
            const emtpyContentForm = currentPage.querySelector('#empty-content-form')
            const loadingContentForm = currentPage.querySelector('#loading-content-form')

            if (!contentForm.classList.contains('hidden')) {
                contentForm.classList.add('hidden');
            };

            emtpyContentForm.classList.add('hidden');
            loadingContentForm.classList.remove('hidden');

            // Update content dynamically via AJAX using POST
            fetch('/dashboard/web/review/form', {
                method: 'POST', // Change to POST
                headers: {
                    'Content-Type': 'application/json', // Specify the content type as JSON
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token if necessary
                },
                body: JSON.stringify({ content: content, type: type }) // Pass content and type in the body
            })
            .then(response => {
                if (!response.ok) {
                    console.log(response)
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(html => {

                currentPage.querySelector('#content-form').innerHTML = html;
                loadingContentForm.classList.add('hidden');
                contentForm.classList.remove('hidden');
            })
            .catch(error => console.error('Error loading content:', error));

        }


        document.addEventListener('web-content-card-review', function (e) {
            const content = e.detail.content;
            const type = e.detail.type;
            updateFormState(content,type);
        });

        const createButton = document.querySelector('#create_button');

        if (createButton) {
            createButton.addEventListener('click', function(e) {
                updateFormState(null, 'create');
            });
        }


    });

    function clearContent() {

        const currentPage = document.querySelector('#dashboard_web_review');
        const contentForm  = currentPage.querySelector('#content-form');
        const emtpyContentForm = currentPage.querySelector('#empty-content-form ')

        emtpyContentForm.classList.remove('hidden');
        contentForm.classList.add('hidden');
    }




</script>
