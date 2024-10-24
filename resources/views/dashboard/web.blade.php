
@extends('layouts.dashboard')

@section('content-dashboard')

    @php
        // Find the label of the current option based on the selected value
        $currentContent = null;
        $typeOfRequest  = null;
    @endphp

    <section id="dashboard_web" class="bg-gray-light h-full w-full flex flex-row gap-x-4 p-4">
        <div class="w-full h-full flex flex-col bg-white rounded-xl p-4 gap-y-2">
            <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.web.header') }}</h4>
            <x-search-bar
                id='web-content-search'
                dropDownId="dashboard-web-search-bar"
                :currentDropDownOption="$type"
                :dropDownOptions="[
                    ['label' => __('messages.dashboard.web.dropdown.review'), 'value' => 'review'],
                    ['label' => __('messages.dashboard.web.dropdown.service'), 'value' => 'service'],
                    ['label' => __('messages.dashboard.web.dropdown.supplier'), 'value' => 'supplier'],
                    ['label' => __('messages.dashboard.web.dropdown.product'), 'value' => 'product']
                ]"
                placeholderInput='messages.dashboard.web.input_placeholder_search'
                labelButton='messages.dashboard.web.button_label_search'
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
                    <a href="{{route('dashboard_web',['page' => 1 ] )}}" class="{{$pagination['currentPage'] == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center   duration-300 cursor-pointer  p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                    </a>

                    <a href="{{ route('dashboard_web', ['page' =>$pagination['currentPage'] - 1]) }}" class="{{$pagination['currentPage'] == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                </div>

                <div class="w-auto flex flex-row gap-x-1">
                    <a  href="{{ route('dashboard_web', ['page' =>$pagination['currentPage'] + 1]) }}" class="{{$pagination['lastPage'] == $pagination['currentPage'] ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full"><path d="m9 18 6-6-6-6"/></svg>
                    </a>

                    <a href="{{ route('dashboard_web', ['page' =>$pagination['lastPage']]) }}" class="{{$pagination['lastPage'] == $pagination['currentPage'] ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-[40%] h-full bg-white rounded-xl flex flex-col p-4">
            @if($currentContent == null )
                <div class="w-full h-full flex flex-col items-center justify-center">
                    <img src="/images/svg/empty.svg" class="w-[40%] h-auto"/>
                    <label>{{__('messages.dashboard.web.empty_content')}}</label>
                </div>
            @elseif($currentContent != null && $typeOfRequest != null )
                <x-web-review-form/>
            @endif
        </div>
        </div>
    </section>
@endsection

<script>


    document.addEventListener("DOMContentLoaded", function() {

        const dropDownSelector = document.querySelector(`.drop-down-selector[data-id='dashboard-web-search-bar']`);
        // Listen for the custom event
        dropDownSelector.addEventListener('dropdown-dashboard-web-search-bar', function (e) {
            const value = e.detail.value; // Get the selected value
            // Construct the new route
            const newRoute = `/dashboard/web?page=1&type=${value}`;

            // Navigate to the new route
            window.location.href = newRoute;
        });


        document.addEventListener('web-content-selected', function (e) {
            const content = e.detail.content;
            const type = e.detail.type;

            // Update content dynamically via AJAX
            fetch(`/dashboard/web/details?content=${content}&type=${type}`)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('.right-container').innerHTML = html;
                })
                .catch(error => console.error('Error loading content:', error));
        });

    });
</script>
