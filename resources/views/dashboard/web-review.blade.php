@extends('layouts.dashboard')

@section('content-dashboard')

    <section id="dashboard_web_review" class="bg-gray-light h-full w-full flex flex-row gap-x-4 p-4">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="w-full h-full flex flex-col bg-white rounded-xl p-4 gap-y-2">
            <div class="w-full h-auto flex flex-row justify-between">
                <div class="w-auto h-auto flex flex-row">
                    <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1 group-hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </span>
                    <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.web.review.header') }}</h4>
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
        <div class="w-[40%] h-full bg-white rounded-xl flex flex-col p-4">
            <div class="w-auto h-auto flex flex-col items-center justify-center">
                <img src="/images/svg/empty.svg" class="w-[40%] h-auto"/>
                <label>{{__('messages.dashboard.web.empty_content')}}</label>
            </div>
            <div id="content-form">
            </div>
        </div>
        </div>
    </section>
@endsection

<script>


    document.addEventListener("DOMContentLoaded", function() {

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


        document.addEventListener('web-content-card-review', function (e) {
            const content = e.detail.content;
            const type = e.detail.type;

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
                const currentPage = document.querySelector('#dashboard_web_review');
                currentPage.querySelector('#content-form').innerHTML = html;
            })
            .catch(error => console.error('Error loading content:', error));

        });
    });
</script>
