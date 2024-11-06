@extends('layouts.dashboard')

@section('content-dashboard')

    <section id="dashboard_{{$EntityType}}" class="bg-gray-light h-full w-full flex flex-row xl:gap-x-4 p-4">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="w-full h-full flex flex-col bg-white rounded-xl p-4 gap-y-2">
            <div class="w-full h-auto flex flex-row justify-between py-4">
                <div class="w-auto h-auto flex flex-row items-center gap-x-2">
                    <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1">
                        @if($EntityType == "transport_type")
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-2"><path d="M3 9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9Z"/><path d="m3 9 2.45-4.9A2 2 0 0 1 7.24 3h9.52a2 2 0 0 1 1.8 1.1L21 9"/><path d="M12 3v6"/></svg>

                        @endif
                    </span>
                    <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.'.$EntityType.'.header') }}</h4>
                </div>

                <div class="w-auto h-auto flex flex-row">
                    <button id="create_button" class="w-auto h-full px-4 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2">
                        {{__('messages.dashboard.'.$EntityType.'.new_entity')}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    </button>
                </div>
            </div>

            <x-search-bar
                id='content-{{$EntityType}}-search'
                dropDownId="dashboard-{{$EntityType}}-search-bar"
                :currentDropDownOption="$currentFilter"
                :dropDownOptions="$filters"
                placeholderInput='messages.dashboard.{{$EntityType}}.input_placeholder_search'
                labelButton='messages.dashboard.{{$EntityType}}.button_label_search'
            />
            <div class="w-full flex flex-col overflow-y-scroll no-scroll-bar">
                <div class="w-full flex flex-col gap-y-2">
                    @foreach ($pagination->items() as $paginate)
                    @endforeach
                </div>
            </div>
            <div class="w-full h-auto flex flex-row justify-between mt-auto">
                <div class="w-auto flex flex-row gap-x-1">
                    <a href="{{route('dashboard_'.$EntityType,['page' => 1 ] )}}" class="{{$pagination->currentPage() == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center   duration-300 cursor-pointer  p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                    </a>

                    <a href="{{ route('dashboard_'.$EntityType, ['page' =>$pagination->currentPage() - 1]) }}" class="{{$pagination->currentPage() == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                </div>

                <div class="w-auto flex flex-row gap-x-1">
                    <a  href="{{ route('dashboard_'.$EntityType, ['page' =>$pagination->currentPage() + 1]) }}" class="{{$pagination->lastPage() == $pagination->currentPage() ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full"><path d="m9 18 6-6-6-6"/></svg>
                    </a>

                    <a href="{{ route('dashboard_'.$EntityType, ['page' =>$pagination->lastPage()]) }}" class="{{$pagination->lastPage() == $pagination->currentPage() ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="dashboard_content_form max-xl:fixed max-xl:top-0 max-xl:bottom-0 max-sm:-right-[100%] max-xl:-right-[600px] w-full  sm:w-[600px] max-xl:border-s-2 xl:w-[50%] h-full bg-white rounded-xl flex flex-col items-center justify-center p-4 transition-all duration-300">
            <div class="w-full h-auto flex flex-row justify-end px-4 xl:hidden absolute top-4 right-4 z-[1200]">
                <span class="dashboard_button_toggle_content h-12 w-12 flex items-center justify-center border-2 border-gray-light rounded-xl cursor-pointer hover:bg-primary-dark text-white bg-secondary-dark duration-300 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </span>
            </div>
            <div id="empty-content-form" class="w-auto h-auto flex flex-col items-center justify-center">
                <img src="/images/svg/empty.svg" class="w-[40%] h-auto"/>
                <label>{{__('messages.dashboard.'.$EntityType.'.empty_content')}}</label>
            </div>
            <div id="loading-content-form" class="hidden w-full h-full flex items-center justify-center">
                <span class="animate-spin p-1 h-12 w-12 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </span>
            </div>
            <div id="content-form" class="hidden h-full w-full overflow-y-scroll">
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>

        function toggleFormContent(){

            const menu = document.querySelector('.dashboard_content_form');

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

        function clearContent() {
            toggleFormContent();
            const currentPage = document.querySelector('#dashboard_{{$EntityType}}');
            const contentForm  = currentPage.querySelector('#content-form');
            const emtpyContentForm = currentPage.querySelector('#empty-content-form ')

            emtpyContentForm.classList.remove('hidden');
            contentForm.classList.add('hidden');
        };

        document.addEventListener("DOMContentLoaded", function() {

            @if (session('success'))
                showToast(["{{ session('success') }}"]);
            @endif

            @if (session('error'))
                showToast(["{{ session('error') }}"]);
            @endif

            @if(session('errors'))
                @if(session('errors') == "create")
                    updateFormState(null,"{{$EntityType}}","{{ session('formRequest') }}");
                @else
                    updateFormState("{{ session('EntityId') }}","{{$EntityType}}","{{ session('formRequest') }}");
                @endif
            @endif



            // Select the button and the menu
            const menuButtons = document.querySelectorAll('.dashboard_button_toggle_content');
            menuButtons.forEach(function(button) {
                button.addEventListener('click', toggleFormContent);
            });



            const SearchBar = document.querySelector(`#content-{{$EntityType}}-search`);
            // Listen for the custom event
            SearchBar.addEventListener('search-content-{{$EntityType}}-search', function (e) {

                const key = e.detail.key; // Get the selected value
                const value = e.detail.value; // Get the selected value
                // Construct the new route
                const newRoute = `/dashboard/{{$EntityType}}?page=1&filterKey=${key}&filterValue=${value}`;

                // Navigate to the new route
                window.location.href = newRoute;
            });



            function updateFormState(idEntity, typeEntity,formRequest){

                toggleFormContent();

                const currentPage = document.querySelector('#dashboard_{{$EntityType}}');
                const contentForm  = currentPage.querySelector('#content-form');
                const emtpyContentForm = currentPage.querySelector('#empty-content-form')
                const loadingContentForm = currentPage.querySelector('#loading-content-form')

                if (!contentForm.classList.contains('hidden')) {
                    contentForm.classList.add('hidden');
                };

                emtpyContentForm.classList.add('hidden');
                loadingContentForm.classList.remove('hidden');

                // Update content dynamically via AJAX using POST
                fetch('/dashboard/{{$EntityType}}/form', {
                    method: 'POST', // Change to POST
                    headers: {
                        'Content-Type': 'application/json', // Specify the content type as JSON
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token if necessary
                    },
                    body: JSON.stringify({ idEntity: idEntity, typeEntity:typeEntity,  formRequest: formRequest }) // Pass content and type in the body
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

                     // Check for errors and populate error messages
                    @if(session('errors'))
                        const errors = @json(session('errors')->toArray());
                        console.log(errors);
                        for (const [field, message] of Object.entries(errors)) {
                            const errorSpan = document.getElementById(`error-${field}`);
                            if (errorSpan) {
                                errorSpan.textContent = message[0]; // Assuming messages are in an array
                            }
                        }
                    @endif
                })
                .catch(error => console.error('Error loading content:', error));

            }


            document.addEventListener('content-card-{{$EntityType}}', function (e) {
                const idEntity = e.detail.idEntity;
                const typeEntity = e.detail.typeEntity;
                const formRequest = e.detail.formRequest;

                updateFormState(idEntity, typeEntity,formRequest);
            });

            const createButton = document.querySelector('#create_button');

            if (createButton) {
                createButton.addEventListener('click', function(e) {
                    updateFormState(null,'{{$EntityType}}', 'create');
                });
            }

        });


        function selectContent(idEntity, typeEntity,formRequest) {
            // Create a custom event to notify that the card has been selected
            const event = new CustomEvent('content-card-{{$EntityType}}', {
                detail: { idEntity, typeEntity,formRequest }
            });

            // Dispatch the custom event
            document.dispatchEvent(event);
        }



        function previewImage(event, fieldName) {
            const fieldId = `image-viewer-${fieldName}`;
            const imageView = document.getElementById(fieldId);
            const file = event.target.files[0];

            if (file && imageView) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imageView.style.backgroundImage = `url(${e.target.result})`;
                };
                reader.readAsDataURL(file);
            }
        }


        function addEntity(entity,name) {
            // Get the selected supplier
            const selectElement = document.querySelector(`select[name='${entity}s_options']`);
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const entityId = selectedOption.value;
            const entityName = selectedOption.text;

            if(!entityId){
                return;
            };

            // Select all hidden inputs within the entity container (suppliers-container, etc.)
            const currentIds = document.querySelectorAll(`#${entity}s-container input[type="hidden"]`);

            // Check if any hidden input contains the desired entity ID in its value
            let entityExists = Array.from(currentIds).some(input => Number(input.value) === Number(entityId));

            if (entityExists) {
                return; // Stop if entity already exists in the hidden inputs
            }

            entityIndex = document.querySelectorAll(`#${entity}s-container .${entity}-item`).length;
            // Create a new div to hold the detail inputs
            const entityContainer = document.createElement("div");
            entityContainer.classList.add(`${entity}-item`, "mb-4", "mt-4", "border-2","border-secondary-dark","flex","flex-col", "rounded-md","p-4","animation-element","in-view","slide-in-up");

            const containerHeader = document.createElement('div');
            containerHeader.classList.add('flex','flex-row','justify-between','w-full', 'h-auto')

            const entityTitle = document.createElement("p");
            entityTitle.classList.add("text-sm", "font-bold", "text-primary", "capitalize");
            entityTitle.innerText = `${name} ${entityId}`;
            containerHeader.appendChild(entityTitle);

            const deleteEntityButton = document.createElement("button");
            deleteEntityButton.classList.add("text-sm", "font-bold", "text-primary", "capitalize","rounded-xl","active:scale-95","duration-300","transition-all","bg-secondary-dark","hover:bg-primary","px-4", "py-2","text-white");
            deleteEntityButton.innerText = "{{ __('messages.common.delete') }}";

            // Add delete functionality
            deleteEntityButton.onclick = function() {
                entityContainer.remove(); // Remove the detail container
                updateEntityIndex(entity); // Update the titles of remaining details
            };

            containerHeader.appendChild(deleteEntityButton);
            entityContainer.appendChild(containerHeader);


            const entityInput = document.createElement("input");
            entityInput.value = entityName;
            entityInput.classList.add("mt-2","text-sm", "block", "w-full", "p-2", "border-b-2", "border-b-secondary-dark", "bg-white", "focus:border-b-primary", "focus:outline-none", "text-body");
            entityInput.placeholder = `{{ __('messages.dashboard.web.${entity}.form.placeholders.suppliers') }}`;
            entityInput.disabled = true;
            entityContainer.appendChild(entityInput);


            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = `${entity}s[${entityIndex}]`;
            hiddenInput.value = entityId;
            entityContainer.appendChild(hiddenInput);

            // Append the new detail container to the main container
            document.getElementById(`${entity}s-container`).appendChild(entityContainer);

            // Increment the detail index for the next detail
            entityIndex++;
        }

    function updateEntityIndex(entity) {
        const entityItems = document.querySelectorAll(`.${entity}-item`);
        entityItems.forEach((entityItem, index) => {

            const hiddenInput = entityItem.querySelector("input[type='hidden']");
            if (hiddenInput) {
                hiddenInput.name = `${entity}s[${index}]`;
            }
        });
        // Update detailIndex to the current count
        detailIndex = entityItems.length;
    }

    </script>
@endpush
