@extends('layouts.dashboard')

@section('content-dashboard')

    <section id="dashboard_{{$EntityType}}" class="bg-gray-light h-full w-full flex flex-row xl:gap-x-4 p-4">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="w-full h-full flex flex-col bg-white rounded-xl p-4 gap-y-2">
            <div class="w-full h-auto flex flex-row justify-between py-4">
                <div class="w-auto h-auto flex flex-row items-center gap-x-2">
                    <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1">
                        @if($EntityType == "transport_type")
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        @elseif($EntityType == "client")
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        @elseif($EntityType == "order")
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M21 7h-3a2 2 0 0 1-2-2V2"/><path d="M21 6v6.5c0 .8-.7 1.5-1.5 1.5h-7c-.8 0-1.5-.7-1.5-1.5v-9c0-.8.7-1.5 1.5-1.5H17Z"/><path d="M7 8v8.8c0 .3.2.6.4.8.2.2.5.4.8.4H15"/><path d="M3 12v8.8c0 .3.2.6.4.8.2.2.5.4.8.4H11"/></svg>

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
                        @if($EntityType == "transport_type")
                            <x-transport-type-card :data="$paginate"/>
                        @elseif($EntityType == "client")
                            <x-client-card :data="$paginate"/>
                        @elseif($EntityType == "order")
                            <x-order-card :data="$paginate"/>
                        @endif
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
            <div id="empty-content-form" class="w-auto h-auto flex flex-col items-center justify-center gap-y-4">
                <img src="/storage/images/web/empty.svg" class="w-[30%] h-auto"/>
                <label class="capitalize">{{__('messages.dashboard.'.$EntityType.'.empty_content')}}</label>
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

                    if(typeEntity == "order"){
                        loadOrderFunction();
                    }

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

        let freightsContainer = null;
        let addFreightButton = null;

        // Function to add a new Freight Card
        function addFreightCard() {
            const index = freightsContainer.children.length;

            // Create a new freight card div
            const freightCard = document.createElement("div");
            freightCard.classList.add("freight-card", "w-full", "h-auto", "grid", "grid-cols-2", "text-body", "gap-y-2", "border-2", "border-gray-light", "rounded-xl", "p-4", "gap-4");
            freightCard.innerHTML = `
                <div class="col-span-2 flex flex-row justify-between items-center">
                    <div class="inline-flex gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <path d="M22 7.7c0-.6-.4-1.2-.8-1.5l-6.3-3.9a1.72 1.72 0 0 0-1.7 0l-10.3 6c-.5.2-.9.8-.9 1.4v6.6c0 .5.4 1.2.8 1.5l6.3 3.9a1.72 1.72 0 0 0 1.7 0l10.3-6c.5-.3.9-1 .9-1.5Z"/>
                            <path d="M10 21.9V14L2.1 9.1"/>
                            <path d="m10 14 11.9-6.9"/>
                            <path d="M14 19.8v-8.1"/>
                            <path d="M18 17.5V9.4"/>
                        </svg>
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{__("messages.dashboard.freight.name")}}:</p>
                    </div>
                    <button type="button" id="delete_freight_btn_${index}" class="bg-primary hover:bg-primary-dark duration-300 p-2 rounded-lg transition-all text-white border-2 border-primary hover:border-primary-dark active:scale-95">{{__("messages.dashboard.freight.delete_entity")}}</button>
                </div>

                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.name') }}:</p>
                    <input type="text" id="freight[${index}][name]" name="freight[${index}][name]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white" placeholder="{{ __("messages.dashboard.freight.form.placeholders.name") }}">
                </div>

                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.description') }}:</p>
                    <input type="text" id="freight[${index}][description]" name="freight[${index}][description]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white" placeholder="{{ __("messages.dashboard.freight.form.placeholders.description") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions_units') }}:</p>
                    <input type="text" id="freight[${index}][dimensions_units]" name="freight[${index}][dimensions_units]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.dimensions_units") }}">
                </div>

                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions') }}:</p>
                    <input type="text" id="freight[${index}][dimensions]" name="freight[${index}][dimensions]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.dimensions") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight_units') }}:</p>
                    <input type="text" id="freight[${index}][weight_units]" name="freight[${index}][weight_units]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.weight_units") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight') }}:</p>
                    <input type="text" id="freight[${index}][weight]" name="freight[${index}][weight]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.weight") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume_units') }}:</p>
                    <input type="text" id="freight[${index}][volume_units]" name="freight[${index}][volume_units]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.volume_units") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume') }}:</p>
                    <input type="text" id="freight[${index}][volume]" name="freight[${index}][volume]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.volume") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.packages') }}:</p>
                    <input type="text" id="freight[${index}][packages]" name="freight[${index}][packages]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.volume") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.incoterms') }}:</p>
                    <input type="text" id="freight[${index}][incoterms]" name="freight[${index}][incoterms]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.incoterms") }}">
                </div>
            `;

            // Append the new freight card to the container
            freightsContainer.appendChild(freightCard);

            // Add event listener for delete button
            const deleteButton = freightCard.querySelector(`#delete_freight_btn_${index}`);
            deleteButton.addEventListener("click", () => deleteFreightCard(freightCard));
        }

        // Function to delete a Freight Card
        function deleteFreightCard(card) {
            card.remove();
            updateFreightIndices();
        }

        // Function to update the indices of Freight Cards
        function updateFreightIndices() {
            const freightCards = freightsContainer.children;
            Array.from(freightCards).forEach((card, index) => {
                card.querySelectorAll("input").forEach(input => {
                    input.id = input.id.replace(/\[\d+\]/, `[${index}]`);
                    input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
                });

                card.querySelector("p.text-secondary-dark").innerText = `Freight ${index + 1}:`;
            });
        }

        function handleToggleWrapScrollers(id){

            const toggleButton = document.getElementById(`toggleButton_${id}`);
            const wrapperContainer = document.getElementById(`wrapperContainer_${id}`);
            const wrapperText = document.getElementById(`wrapper_${id}`);
            const iconOpen = document.getElementById(`iconOpen_${id}`);
            const iconClose = document.getElementById(`iconClose_${id}`);

            // Toggle the height and opacity classes
            wrapperContainer.classList.toggle("h-[0px]");
            wrapperContainer.classList.toggle("h-[400px]");
            wrapperContainer.classList.toggle("sm:h-[600px]");

            // Toggle opacity for the wrapper text
            wrapperText.classList.toggle("opacity-0");
            wrapperText.classList.toggle("opacity-100");

            // Toggle the icon
            iconOpen.classList.toggle("hidden");
            iconClose.classList.toggle("hidden");

        }

        function attachIconImageUpdate() {
            const iconSelect = document.getElementById('icon-tracking-step');
            const iconImage = document.getElementById('icon-tracking-step-image');

            if (iconSelect && iconImage) {
                // Set the initial image based on the selected option
                iconImage.src = iconSelect.value ? '/storage'+iconSelect.value : '/storage/images/svgs/ambulance.svg';

                // Remove any existing event listeners to avoid duplicates
                iconSelect.removeEventListener('change', updateIconImage);

                // Add a new event listener to update the image
                iconSelect.addEventListener('change', updateIconImage);
            }
        }

        function updateIconImage() {
            const iconSelect = document.getElementById('icon-tracking-step');
            const iconImage = document.getElementById('icon-tracking-step-image');

            // Update the image source to the selected option or default to ambulance
            const selectedIcon = iconSelect.value;
            iconImage.src = selectedIcon ? '/storage'+selectedIcon : '/storage/images/svgs/ambulance.svg';
        }


        function initializeDragAndDrop(containerSelector, itemSelector) {
          const container = document.querySelector(containerSelector);

          if (!container) return;

          let draggedItem = null;

          // Handle drag start when clicking the SVG
          container.addEventListener("mousedown", (e) => {
            const svg = e.target.closest("span.cursor-pointer"); // Ensure the click is on the SVG container
            const item = e.target.closest(`.${itemSelector}`);

            if (svg && item) {
              draggedItem = item;
              item.setAttribute("draggable", true); // Enable drag only on click
              item.classList.add("dragging");

              // Start the drag
              item.addEventListener("dragstart", (e) => {
                // Hide the default drag image
                e.dataTransfer.setDragImage(new Image(), 0, 0);

                document.addEventListener("mousemove", moveDraggedItem);
                setTimeout(() => (item.classList.add("block")), 0);
              });

              // End the drag
              item.addEventListener("dragend", (e) => {
                item.classList.remove("dragging");
                item.classList.remove("block");
                draggedItem = null;
                document.removeEventListener("mousemove", moveDraggedItem);
                item.setAttribute("draggable", false); // Disable dragging again
              });
            }
          });

          container.addEventListener("dragover", (e) => {
            e.preventDefault();
            const afterElement = getDragAfterElement(container, e.clientY);
            if (draggedItem && afterElement == null) {
              container.appendChild(draggedItem);
            } else if (draggedItem) {
              container.insertBefore(draggedItem, afterElement);
            }
            updateTransportIndices(); // Update the order during the drag
          });

        // Function to move the dragged item with the cursor
          function moveDraggedItem(e) {
            if (draggedItem) {
              draggedItem.style.position = "absolute";
              draggedItem.style.pointerEvents = "none"; // Prevent interference with the mouse
              draggedItem.style.top = `${e.clientY}px`;
              draggedItem.style.left = `${e.clientX}px`;
              draggedItem.style.zIndex = "1000";
            }
          }

          function getDragAfterElement(container, y) {
            const draggableElements = [
              ...container.querySelectorAll(`.${itemSelector}:not(.dragging)`),
            ];

            return draggableElements.reduce(
              (closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                  return { offset: offset, element: child };
                } else {
                  return closest;
                }
              },
              { offset: Number.NEGATIVE_INFINITY }
            ).element;
          }

          // Initial call to ensure correct order
          updateTransportIndices();
        }

        //add Transport Types

        let transportsContainer = null;
        let addTransportButton = null;
        // Function to add a new Transport Card
        function addTransportCard() {
            const index = transportsContainer.children.length;

            const container_fields = document.getElementById("container_new_tracking_step");

            //extract fields

            const country_field = document.getElementById("country-tracking-step").value;
            const city_field = document.getElementById("city-tracking-step").value;
            const address_field = document.getElementById("address-tracking-step").value;
            const icon_field = document.getElementById("icon-tracking-step").value;
            const type_field = document.getElementById("type-tracking-step").value;
            const status_field = document.getElementById("status-tracking-step").value;
            const name_field = document.getElementById("name-tracking-step").value;
            const external_reference_field  = document.getElementById("external-reference-tracking-step").value;
            const description_field  = document.getElementById("description-tracking-step").value;


            // Create a new freight card div
            const transportCard = document.createElement("div");
            transportCard.classList.add("step-track", "w-full", "h-auto", "flex", "flex-row", "items-center", "justify-between", "px-4", "py-2", "border-2", "border-gray-200", "rounded-xl");
            transportCard.innerHTML = `
                <div class="w-auto h-full flex flex-row justify-start items-center gap-x-2">
                    <p class="step-track-correlative text-sm font-bold text-body">${index + 1}</p>
                    <img id="step-track-icon" onClick="updateTransportActiveState(${index})" src="/storage/${icon_field}" class="step-track-icon h-12 w-12 shadow-md p-2 border-gray-light border-4 text-primary rounded-full duration-300 hover:border-primary cursor-pointer active:scale-95"/>
                    <label for="steps-track" class="block text-sm font-bold text-secondary-dark capitalize">${name_field}</label>
                </div>

                <div class="w-auto h-full flex flex-row justify-start items-center gap-x-2">
                    <span class="text-gray-400 h-6 w-6 cursor-pointer hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-justify"><path d="M3 12h18"/><path d="M3 18h18"/><path d="M3 6h18"/></svg>
                    </span>
                    <button id="delete_transport_btn_${index}" type="button" class="h-8 w-8 bg-primary hover:bg-white text-white hover:text-primary duration-300 rounded-full p-1 border-2 border-primary active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>


                <input type="text" id="transports[${index}][country]" name="transports[${index}][country]" class="hidden" value="${country_field}">
                <input type="text" id="transports[${index}][city]" name="transports[${index}][city]" class="hidden" value="${city_field}">
                <input type="text" id="transports[${index}][address]" name="transports[${index}][address]" class="hidden" value="${address_field}">
                <input type="text" id="transports[${index}][name]" name="transports[${index}][name]" class="hidden" value="${name_field}">
                <input type="text" id="transports[${index}][type]" name="transports[${index}][type]" class="hidden" value="${type_field}">
                <input type="text" id="transports[${index}][status]" name="transports[${index}][status]" class="hidden" value="${status_field}">
                <input type="text" id="transports[${index}][external_reference]" name="transports[${index}][external_reference]" class="hidden" value="${external_reference_field}">
                <input type="text" id="transports[${index}][description]" name="transports[${index}][description]" class="hidden" value="${description_field}">
                <input type="text" id="transports[${index}][icon]" name="transports[${index}][icon]" class="hidden" value="${icon_field}">
            `;

            // Append the new freight card to the container
            transportsContainer.appendChild(transportCard);

            const deleteButton = transportCard.querySelector(`#delete_transport_btn_${index}`);
            deleteButton.addEventListener("click", () => deleteTransportCard(transportCard));
        }

        // Function to delete a Transport Card
        function deleteTransportCard(card) {
            card.remove();
            updateTransportIndices();
        }

        function updateTransportActiveState(clickedIndex) {
            const transportCards = document.querySelectorAll('.step-track');

            transportCards.forEach((card, index) => {
                const icon = card.querySelector('.step-track-icon');
                const statusInput = card.querySelector(`input[id^="transports[${index}]"][name*="[status]"]`);

                if (index <= clickedIndex) {
                    // Set status to ACTIVE for current and previous steps
                    statusInput.value = 'ACTIVE';

                    // Add border-primary class to the icon
                    icon.classList.add('border-primary');
                    icon.classList.remove('border-gray-light');
                } else {
                    // Set status to INACTIVE for the remaining steps
                    statusInput.value = 'INACTIVE';

                    // Remove border-primary class from the icon
                    icon.classList.remove('border-primary');
                    icon.classList.add('border-gray-light');
                }
            });
        }

        // Function to update the indices of Transport Cards
        function updateTransportIndices() {
            const transportCards = transportsContainer.children;
            Array.from(transportCards).forEach((card, index) => {
                card.querySelectorAll("input").forEach(input => {
                    input.id = input.id.replace(/\[\d+\]/, `[${index}]`);
                    input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
                });

                card.querySelector("p.step-track-correlative").innerText = `${index + 1}:`;

                // Update the onClick attribute of the step-track-icon
                const icon = card.querySelector(".step-track-icon");
                icon.addEventListener("click", function(){
                    updateTransportActiveState(index);
                });

                // Update the ID of the delete button
                const deleteButton = card.querySelector('button[id^="delete_transport_btn_"]');
                deleteButton.id = `delete_transport_btn_${index}`;
            });

        }

        function loadOrderFunction(){
            freightsContainer = document.getElementById("freights-items");
            addFreightButton = document.getElementById("add_fregiht_btn");
            // Add event listener for the add button
            addFreightButton.addEventListener("click", addFreightCard);

            transportsContainer = document.querySelector(".step-tracks");
            addTransportButton = document.getElementById("add_transport_btn");
            // Add event listener for the add button
            addTransportButton.addEventListener("click", addTransportCard);

            document.querySelectorAll('.step-track-icon').forEach((icon, index) => {
                icon.addEventListener('click', function () {
                    updateTransportActiveState(index);
                });
            });

            // Select all sub-sections with the "data-id" attribute
            const subSections = document.querySelectorAll("[id^='sub_section_']");

            // Iterate through each sub-section and attach the toggle functionality
            subSections.forEach(subSection => {
                const id = subSection.getAttribute("data-id");
                const toggleButton = document.getElementById(`toggleButton_${id}`);

                if (toggleButton) {
                    toggleButton.addEventListener("click", function () {
                        handleToggleWrapScrollers(id);
                    });
                }
            });

            //Attach Image update for the selected Icon for the tracking step
            attachIconImageUpdate();

            // Initialize drag and drop for .step-tracks and .step-track
            initializeDragAndDrop(".step-tracks", "step-track");

        }


    </script>
@endpush
