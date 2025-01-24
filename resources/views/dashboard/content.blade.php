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
    <x-order-status-modal/>
    <x-order-custom-email-modal/>
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
                        loadOrderFunction(idEntity);
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
                    <input type="text" id="freight[${index}][name]" name="freight[${index}][name]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white" placeholder="{{ __("messages.dashboard.freight.form.placeholders.name") }}">
                </div>

                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.origin') }}:</p>
                    <input type="text" id="freight[${index}][origin]" name="freight[${index}][origin]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white" placeholder="{{ __("messages.dashboard.freight.form.placeholders.origin") }}">
                </div>

                <div class="col-span-2 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.description') }}:</p>
                    <input type="text" id="freight[${index}][description]" name="freight[${index}][description]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white" placeholder="{{ __("messages.dashboard.freight.form.placeholders.description") }}">
                </div>


                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions_units') }} ({{ __('messages.common.optional') }}):</p>
                    <select id="freight[${index}][dimensions_units]" name="freight[${index}][dimensions_units]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body">

                        <option value="">{{ __("messages.dashboard.freight.form.fields.dimensions_units") }}</option>

                        <option value="m">{{ __("messages.common.meters") }}</option>
                        <option value="mm">{{ __("messages.common.milimeters") }}</option>
                        <option value="cm">{{ __("messages.common.centimeters") }}</option>
                        <option value="in">{{ __("messages.common.inches") }}</option>
                    </select>
                </div>

                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions') }} ({{ __('messages.common.optional') }}):</p>
                    <input type="number" id="freight[${index}][dimensions]" name="freight[${index}][dimensions]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.dimensions") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight_units') }} ({{ __('messages.common.optional') }}):</p>
                    <select id="freight[${index}][weight_units]" name="freight[${index}][weight_units]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body">

                        <option value="">{{ __("messages.dashboard.freight.form.fields.weight_units") }}</option>
                        <option value="kg">{{ __("messages.common.kilograms") }}</option>
                        <option value="lbs">{{ __("messages.common.pounds") }}</option>
                    </select>
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight') }} ({{ __('messages.common.optional') }}):</p>
                    <input type="number" id="freight[${index}][weight]" name="freight[${index}][weight]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.weight") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume_units') }} ({{ __('messages.common.optional') }}):</p>
                    <select id="freight[${index}][volume_units]" name="freight[${index}][volume_units]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body">

                        <option value="">{{ __("messages.dashboard.freight.form.fields.volume_units") }}</option>

                        <option value="m3">{{ __("messages.common.cubic_meters") }}</option>
                        <option value="mm3">{{ __("messages.common.cubic_milimeters") }}</option>
                        <option value="cm3">{{ __("messages.common.cubic_centimeters") }}</option>
                        <option value="in3">{{ __("messages.common.cubic_inches") }}</option>

                    </select>
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume') }} ({{ __('messages.common.optional') }}):</p>
                    <input type="number" id="freight[${index}][volume]" name="freight[${index}][volume]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.volume") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.packages') }}:</p>
                    <input type="text" id="freight[${index}][packages]" name="freight[${index}][packages]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.packages") }}">
                </div>
                <div class="col-span-1 flex flex-col justify-start items-start">
                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.incoterms') }}:</p>
                    <input type="text" id="freight[${index}][incoterms]" name="freight[${index}][incoterms]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.freight.form.placeholders.incoterms") }}">
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
                card.querySelectorAll("input, select").forEach(element => {
                  element.id = element.id.replace(/\[\d+\]/, `[${index}]`);
                  element.name = element.name.replace(/\[\d+\]/, `[${index}]`);
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
            wrapperContainer.classList.toggle("h-[600px]");
            wrapperContainer.classList.toggle("sm:h-[600px]");

            // Toggle opacity for the wrapper text
            wrapperText.classList.toggle("opacity-0");
            wrapperText.classList.toggle("opacity-100");

            // Toggle the icon
            iconOpen.classList.toggle("hidden");
            iconClose.classList.toggle("hidden");

        }

        function attachIconImageUpdates(OrderId) {
            // Select all transport icon dropdowns
            const iconSelects = document.querySelectorAll('[id^="transports["][id$="icon]"]');

            const order = OrdersData.find((item) => item.id == Number(OrderId) )

            iconSelects.forEach((iconSelect) => {
                const index = iconSelect.id.match(/\[([^\]]+)\]/)?.[1]; // Extract the index from the ID
                if (index) {

                    const iconImage = document.getElementById(`icon-tracking-step-image-${index}`);

                    if (iconImage) {
                        attachIconImageUpdate(iconSelect, iconImage);
                    }

                    iconSelect.value = order.tracking_steps[index].transport_type.icon;
                    iconImage.src = `/storage${order.tracking_steps[index].transport_type.icon}`;
                }
            });
        }

        function attachIconImageUpdate(iconSelect, iconImage){

                // Set the initial image based on the selected option
                iconImage.src = iconSelect.value
                    ? `/storage${iconSelect.value}`
                    : '/storage/images/svgs/ambulance.svg';

                // Remove existing event listeners to avoid duplicates
                iconSelect.removeEventListener('change', updateIconImage(iconSelect,iconImage));

                // Add a new event listener to update the image dynamically
                iconSelect.addEventListener('change', function () {
                    iconImage.src = this.value
                        ? `/storage${this.value}`
                        : '/storage/images/svgs/ambulance.svg';
                });
        }


        function updateIconImage(iconSelect,iconImage) {
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
        async function addTransportCard(data) {
            const index = transportsContainer.children.length;

            // Create a new freight card div
            const transportCard = document.createElement("div");
            transportCard.classList.add("step-track", "w-full", "h-auto", "flex","flex-col", "items-start", "justify-start", "px-4", "py-2", "border-2", "border-gray-200", "rounded-xl");

            const transportHeaderCard = document.createElement('div');
            transportHeaderCard.classList.add('w-full','h-auto','flex','flex-row','items-center','justify-between','z-[100]');

            // Wrapper left Header
            const WrapperLeftHeader = document.createElement('div');
            WrapperLeftHeader.classList.add('w-auto', 'h-full', 'flex', 'flex-row', 'justify-start', 'items-center', 'gap-x-2');
            transportHeaderCard.appendChild(WrapperLeftHeader);

            // Create elements for the first section
            const stepTrackCorrelative = document.createElement('p');
            stepTrackCorrelative.classList.add('step-track-correlative', 'text-sm', 'font-bold', 'text-body');
            stepTrackCorrelative.textContent = index + 1;

            const stepTrackIcon = document.createElement('img');
            stepTrackIcon.id = `step-track-icon-${index}`;
            stepTrackIcon.src = `{{ asset('storage/' . 'images/svgs/ambulance.svg') }}`;

            if(data){
                if(data.name){
                    stepTrackIcon.src = '/storage'+data.icon;
                }
            }


            stepTrackIcon.classList.add('step-track-icon', 'h-12', 'w-12', 'shadow-md', 'p-2', 'border-4', 'text-primary', 'rounded-full', 'duration-300', 'hover:border-primary', 'cursor-pointer', 'active:scale-95', 'border-gray-light');
            stepTrackIcon.setAttribute('onClick', `updateTransportActiveState(${index})`);

            const stepTrackLabel = document.createElement('label');
            stepTrackLabel.id = `step-track-label-${index}`;
            stepTrackLabel.classList.add('block', 'text-sm', 'font-bold', 'text-secondary-dark', 'capitalize');

            if(data){
                if(data.name){
                    stepTrackLabel.textContent = data.name;
                }
            }

            // Append elements to WrapperLeftHeader
            WrapperLeftHeader.appendChild(stepTrackCorrelative);
            WrapperLeftHeader.appendChild(stepTrackIcon);
            WrapperLeftHeader.appendChild(stepTrackLabel);

            // Create the second section
            const WrapperRightHeader = document.createElement('div');
            WrapperRightHeader.classList.add('w-auto', 'h-full', 'flex', 'flex-row', 'justify-start', 'items-center', 'gap-x-2');

            // Toggle down button
            const toggleDownButton = document.createElement('span');
            toggleDownButton.id = `toogle_down_wrap_content_transport_btn_${index}`;
            toggleDownButton.classList.add('h-8', 'w-8', 'p-1', 'cursor-pointer', 'duration-300', 'text-white', 'rounded-full', 'bg-primary', 'hover:bg-primary-dark', 'active:scale-95');
            toggleDownButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>`;

            // Toggle up button
            const toggleUpButton = document.createElement('span');
            toggleUpButton.id = `toogle_up_wrap_content_transport_btn_${index}`;
            toggleUpButton.classList.add('h-8', 'w-8', 'p-1', 'cursor-pointer', 'duration-300', 'text-white', 'rounded-full', 'bg-primary', 'hover:bg-primary-dark', 'active:scale-95', 'hidden');
            toggleUpButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-up"><path d="m18 15-6-6-6 6"/></svg>`;



            // Align justify icon
            const alignJustifyIcon = document.createElement('span');
            alignJustifyIcon.classList.add('text-gray-400', 'h-6', 'w-6', 'cursor-pointer', 'hover:text-primary');
            alignJustifyIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-justify"><path d="M3 12h18"/><path d="M3 18h18"/><path d="M3 6h18"/></svg>`;

            // Delete button
            const deleteButton = document.createElement('button');
            deleteButton.id = `delete_transport_btn_${index}`;
            deleteButton.type = 'button';
            deleteButton.classList.add('h-8', 'w-8', 'bg-primary', 'hover:bg-white', 'text-white', 'hover:text-primary', 'duration-300', 'rounded-full', 'p-1', 'border-2', 'border-primary', 'active:scale-95');
            deleteButton.setAttribute('onclick', "this.closest('.step-track').remove(); updateTransportIndices()");
            deleteButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>`;

            deleteButton.addEventListener("click", () => deleteTransportCard(transportCard));

            // Append elements to WrapperSecondSection
            WrapperRightHeader.appendChild(toggleDownButton);
            WrapperRightHeader.appendChild(toggleUpButton);
            WrapperRightHeader.appendChild(alignJustifyIcon);
            WrapperRightHeader.appendChild(deleteButton);

            // Append both sections to transportHeaderCard
            transportHeaderCard.appendChild(WrapperLeftHeader);
            transportHeaderCard.appendChild(WrapperRightHeader);

            transportCard.appendChild(transportHeaderCard);


            const transportBodyCard = document.createElement('div');
            transportBodyCard.classList.add(`transports-wrapper-content-${index}`,'w-full','h-[0]','hidden','opacity-0','grid','grid-cols-2','text-body','gap-y-2','border-2','border-gray-light','rounded-xl','gap-4','transition-all','duration-300');



            const headerLabel = document.createElement('label');

            headerLabel.htmlFor = "icon-tracking-step";
            headerLabel.classList.add('block','col-span-2','text-sm','font-bold','text-secondary-dark','capitalize');
            headerLabel.textContent = "{{ __('messages.dashboard.transport_type.form.fields.icon') }}"

            transportBodyCard.appendChild(headerLabel);

            //Country Field
            const CountrySpan = document.createElement('div');
            CountrySpan.classList.add('col-span-1');

            const CountryLabel = document.createElement('label');
            CountryLabel.htmlFor = `transports[${index}][country]`;
            CountryLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            CountryLabel.textContent = "{{ __('messages.dashboard.tracking_step.form.fields.country') }}"

            const CountrySelect = document.createElement('select');
            CountrySelect.id = `transports[${index}][country]`;
            CountrySelect.name =  `transports[${index}][country]`;
            CountrySelect.classList.add('text-sm','mt-1','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body');




            const CountrySelectDefaultOption = document.createElement('option');
            CountrySelectDefaultOption.textContent = "{{ __('messages.dashboard.tracking_step.form.placeholders.country') }}"

            CountrySelect.appendChild(CountrySelectDefaultOption);

            CountrySpan.appendChild(CountryLabel);
            CountrySpan.appendChild(CountrySelect);

            transportBodyCard.appendChild(CountrySpan);

            //City Field

            const CitySpan = document.createElement('div');
            CitySpan.classList.add('col-span-1');

            const CityLabel = document.createElement('label');
            CityLabel.htmlFor = `transports[${index}][city]`;
            CityLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            CityLabel.textContent = "{{ __('messages.dashboard.tracking_step.form.fields.city') }}"

            const CitySelect = document.createElement('select');
            CitySelect.id = `transports[${index}][city]`;
            CitySelect.name =  `transports[${index}][city]`;
            CitySelect.classList.add('text-sm','mt-1','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body');

            const CitySelectDefaultOption = document.createElement('option');
            CitySelectDefaultOption.textContent = "{{ __('messages.dashboard.tracking_step.form.placeholders.city') }}"



            CitySelect.appendChild(CitySelectDefaultOption);

            CitySpan.appendChild(CityLabel);
            CitySpan.appendChild(CitySelect);


            const LattitudeInput = document.createElement('input');
            LattitudeInput.id = `transports[${index}][lat]`;
            LattitudeInput.name = `transports[${index}][lat]`;
            LattitudeInput.classList.add('hidden');
            CitySpan.appendChild(LattitudeInput);

            const LongitudeInput = document.createElement('input');
            LongitudeInput.id = `transports[${index}][lng]`;
            LongitudeInput.name = `transports[${index}][lng]`;
            LongitudeInput.classList.add('hidden');
            CitySpan.appendChild(LongitudeInput);

            AddEventSelectCity(CitySelect,LattitudeInput, LongitudeInput);

            if(data && data.lat && data.lng){
                LattitudeInput.value = data.lat;
                LongitudeInput.value = data.lng;
            }


            transportBodyCard.appendChild(CitySpan);





            //Address Field
            const AddressSpan = document.createElement('div');
            AddressSpan.classList.add('col-span-2');

            const AddressLabel = document.createElement('label');
            AddressLabel.htmlFor = `transports[${index}][address]`;
            AddressLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            AddressLabel.textContent = "{{ __('messages.dashboard.tracking_step.form.fields.address') }}"

            const AddressInput = document.createElement('input');
            AddressInput.id = `transports[${index}][address]`;
            AddressInput.name =  `transports[${index}][address]`;
            AddressInput.classList.add('text-sm','mt-1','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body');
            AddressInput.placeholder = "{{ __('messages.dashboard.tracking_step.form.placeholders.address') }}";

            if(data && data.address){
                AddressInput.value = data.address;
            }

            AddressSpan.appendChild(AddressLabel);
            AddressSpan.appendChild(AddressInput);

            transportBodyCard.appendChild(AddressSpan);

            //Icon Field

            const IconSpan = document.createElement('div');
            IconSpan.classList.add('col-span-2', 'flex', 'flex-row','gap-x-4');

            const IconSelect = document.createElement('select');
            IconSelect.id = `transports[${index}][icon]`;
            IconSelect.name =  `transports[${index}][icon]`;
            IconSelect.classList.add('text-sm','mt-2','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body');
            IconSelect.setAttribute('onchange', `AddHandlerUpdateTrackIcon(this, ${index})`);

            const IconImagePreview = document.createElement('img');
            IconImagePreview.id = `icon-tracking-step-image-${index}`;
            IconImagePreview.src = "/storage/images/svgs/ambulance.svg";
            IconImagePreview.classList.add('h-12','w-12','shadow-md','rounded-xl','p-2','border-2','border-primary','text-primary');




            IconSpan.appendChild(IconSelect);
            IconSpan.appendChild(IconImagePreview);

            transportBodyCard.appendChild(IconSpan);

            //Type Field

            const TypeSpan = document.createElement('div');
            TypeSpan.classList.add('col-span-1');

            const TypeLabel = document.createElement('label');
            TypeLabel.htmlFor = `transports[${index}][type]`;
            TypeLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            TypeLabel.textContent = "{{ __('messages.dashboard.transport_type.form.fields.type') }}"

            const TypeSelect = document.createElement('select');
            TypeSelect.id = `transports[${index}][type]`;
            TypeSelect.name =  `transports[${index}][type]`;
            TypeSelect.classList.add('text-sm','mt-2','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body','capitalize');

            const TypeSelectDefaultOption = document.createElement('option');
            TypeSelectDefaultOption.textContent = "{{ __('messages.dashboard.transport_type.form.fields.SELECT_TRANSPORT_TYPE') }}"
            TypeSelect.appendChild(TypeSelectDefaultOption);

            const TypeSelectLandOption = document.createElement('option');
            TypeSelectLandOption.textContent = "{{ __('messages.dashboard.transport_type.form.fields.LAND') }}"
            TypeSelectLandOption.value = "LAND";
            TypeSelect.appendChild(TypeSelectLandOption);

            const TypeSelectAirOption = document.createElement('option');
            TypeSelectAirOption.textContent = "{{ __('messages.dashboard.transport_type.form.fields.AIR') }}"
            TypeSelectAirOption.value = "AIR";
            TypeSelect.appendChild(TypeSelectAirOption);

            const TypeSelectShipOption = document.createElement('option');
            TypeSelectShipOption.textContent = "{{ __('messages.dashboard.transport_type.form.fields.SHIP') }}"
            TypeSelectShipOption.value = "SHIP";
            TypeSelect.appendChild(TypeSelectShipOption);

            const TypeSelectCustomOption = document.createElement('option');
            TypeSelectCustomOption.textContent = "{{ __('messages.dashboard.transport_type.form.fields.CUSTOM') }}"
            TypeSelectCustomOption.value = "CUSTOM";
            TypeSelect.appendChild(TypeSelectCustomOption);


            TypeSpan.appendChild(TypeLabel);
            TypeSpan.appendChild(TypeSelect);

            transportBodyCard.appendChild(TypeSpan);

            //Status Field

            const StatusSpan = document.createElement('div');
            StatusSpan.classList.add('col-span-1');

            const StatusLabel = document.createElement('label');
            StatusLabel.htmlFor = `transports[${index}][status]`;
            StatusLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            StatusLabel.textContent = "{{ __('messages.dashboard.transport_type.form.fields.status') }}"

            const StatusSelect = document.createElement('select');
            StatusSelect.id = `transports[${index}][status]`;
            StatusSelect.name =  `transports[${index}][status]`;
            StatusSelect.classList.add('text-sm','mt-2','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body','capitalize');

            const StatusSelectDefaultOption = document.createElement('option');
            StatusSelectDefaultOption.textContent = "{{ __('messages.dashboard.transport_type.form.fields.SELECT_TRANSPORT_TYPE') }}"
            StatusSelect.appendChild(StatusSelectDefaultOption);

            const StatusSelectPendingOption = document.createElement('option');
            StatusSelectPendingOption.textContent = "{{ __('messages.dashboard.order.form.fields.PENDING') }}"
            StatusSelectPendingOption.value = "PENDING";
            StatusSelect.appendChild(StatusSelectPendingOption);

            const StatusSelectInTransitOption = document.createElement('option');
            StatusSelectInTransitOption.textContent = "{{ __('messages.dashboard.order.form.fields.IN_TRANSIT') }}"
            StatusSelectInTransitOption.value = "IN_TRANSIT";
            StatusSelect.appendChild(StatusSelectInTransitOption);

            const StatusSelectCompletedOption = document.createElement('option');
            StatusSelectCompletedOption.textContent = "{{ __('messages.dashboard.order.form.fields.COMPLETED') }}"

            StatusSelectCompletedOption.value = "COMPLETED";
            StatusSelect.appendChild(StatusSelectCompletedOption);







            StatusSpan.appendChild(StatusLabel);
            StatusSpan.appendChild(StatusSelect);

            transportBodyCard.appendChild(StatusSpan);

            //Name Field

            const NameSpan = document.createElement('div');
            NameSpan.classList.add('col-span-1');

            const NameLabel = document.createElement('label');
            NameLabel.htmlFor = `transports[${index}][name]`;
            NameLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            NameLabel.textContent = "{{ __('messages.dashboard.transport_type.form.fields.name') }}"

            const NameInput = document.createElement('input');
            NameInput.id = `transports[${index}][name]`;
            NameInput.name =  `transports[${index}][name]`;
            NameInput.classList.add('text-sm','mt-1','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body');
            NameInput.placeholder = "{{ __('messages.dashboard.transport_type.form.placeholders.name') }}";

            if(data && data.name){
                NameInput.value = data.name;
            }

            NameSpan.appendChild(NameLabel);
            NameSpan.appendChild(NameInput);

            transportBodyCard.appendChild(NameSpan);


            //External Reference Field

            const ExternalReferenceSpan = document.createElement('div');
            ExternalReferenceSpan.classList.add('col-span-1');

            const ExternalReferenceLabel = document.createElement('label');
            ExternalReferenceLabel.htmlFor = `transports[${index}][external_reference]`;
            ExternalReferenceLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            ExternalReferenceLabel.textContent = "{{ __('messages.dashboard.transport_type.form.fields.external_reference') }} ({{ __('messages.common.optional') }}):"

            const ExternalReferenceInput = document.createElement('input');
            ExternalReferenceInput.id = `transports[${index}][external_reference]`;
            ExternalReferenceInput.name =  `transports[${index}][external_reference]`;
            ExternalReferenceInput.classList.add('text-sm','mt-1','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body');
            ExternalReferenceInput.placeholder = "{{ __('messages.dashboard.transport_type.form.placeholders.external_reference') }}";

            if(data && data.extref){
                ExternalReferenceInput.value = data.extref;
            }

            ExternalReferenceSpan.appendChild(ExternalReferenceLabel);
            ExternalReferenceSpan.appendChild(ExternalReferenceInput);

            transportBodyCard.appendChild(ExternalReferenceSpan);

            //ETA Field
            const EtaSpan = document.createElement('div');
            EtaSpan.classList.add('col-span-2');

            const EtaLabel = document.createElement('label');
            EtaLabel.htmlFor = `transports[${index}][eta]`;
            EtaLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            EtaLabel.textContent = "{{ __('messages.dashboard.tracking_step.form.fields.eta') }}"

            const EtaInput = document.createElement('input');
            EtaInput.id = `transports[${index}][eta]`;
            EtaInput.type = "datetime-local";
            EtaInput.name =  `transports[${index}][eta]`;
            EtaInput.classList.add('text-sm','mt-1','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body');
            EtaInput.placeholder = "{{ __('messages.dashboard.tracking_step.form.placeholders.eta') }}";

            EtaSpan.appendChild(EtaLabel);
            EtaSpan.appendChild(EtaInput);

            transportBodyCard.appendChild(EtaSpan);

            //Duration Field

            const DurationSpan = document.createElement('div');
            DurationSpan.classList.add('col-span-2');

            const DurationLabel = document.createElement('label');
            DurationLabel.htmlFor = `transports[${index}][duration]`;
            DurationLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            DurationLabel.textContent = "{{ __('messages.dashboard.tracking_step.form.fields.duration') }}"

            const DurationInput = document.createElement('input');
            DurationInput.id = `transports[${index}][duration]`;
            DurationInput.type = "number";
            DurationInput.step = 1;
            DurationInput.name =  `transports[${index}][duration]`;
            DurationInput.classList.add('text-sm','mt-1','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body');
            DurationInput.placeholder = "{{ __('messages.dashboard.tracking_step.form.placeholders.duration') }}";

            DurationSpan.appendChild(DurationLabel);
            DurationSpan.appendChild(DurationInput);

            transportBodyCard.appendChild(DurationSpan);

            //Description Reference Field

            const DescriptionSpan = document.createElement('div');
            DescriptionSpan.classList.add('col-span-2');

            const DescriptionLabel = document.createElement('label');
            DescriptionLabel.htmlFor = `transports[${index}][description]`;
            DescriptionLabel.classList.add('block','text-sm','font-bold','text-secondary-dark','capitalize');
            DescriptionLabel.textContent = "{{ __('messages.dashboard.transport_type.form.fields.description') }}"

            const DescriptionInput = document.createElement('textarea');
            DescriptionInput.id = `transports[${index}][description]`;
            DescriptionInput.name =  `transports[${index}][description]`;
            DescriptionInput.classList.add('text-sm','mt-1','block','w-full','p-2','border-b-2','border-b-secondary-dark','bg-white','focus:border-b-primary','focus:outline-none','text-body');
            DescriptionInput.placeholder = "{{ __('messages.dashboard.transport_type.form.placeholders.description') }}";

            if(data && data.description){
                DescriptionInput.textContent = data.description;
            }

            DescriptionSpan.appendChild(DescriptionLabel);
            DescriptionSpan.appendChild(DescriptionInput);

            transportBodyCard.appendChild(DescriptionSpan);


            //Append the new body Transport to the Card
            transportCard.appendChild(transportBodyCard);

            // Append the new Transport card to the container
            transportsContainer.appendChild(transportCard);


            //Adding Event to the element Created to open and close the content
            toggleTransportContent(`toogle_down_wrap_content_transport_btn_${index}`, `toogle_up_wrap_content_transport_btn_${index}`, `transports-wrapper-content-${index}`);

            // Add an onchange event listener to the input
            NameInput.addEventListener('input', function () {
                AddHandlerUpdateTrackName(NameInput, index);
            });

            attachIconImageUpdate(IconSelect, IconImagePreview);


            attachCountriesOptions(CountrySelect);

            // Add event listener to load cities based on selected country
            CountrySelect.addEventListener('change', function(event) {

                CountrySelect.value = event.target.value;

                if (CitySelect) {
                    loadCities(event.target.value,CountrySelect, CitySelect);
                }

            });

            if(data && data.country){

                CountrySelect.value = data.country;

                if (CitySelect) {

                    await loadCities(data.country,CountrySelect, CitySelect);

                    CitySelect.value = data.city;
                }

            }

            if(data && data.type){
                TypeSelect.value = data.type;
            }

            if(data && data.status){
                StatusSelect.value = data.status;
            }

            const defaultIconOption = document.createElement('option');
            defaultIconOption.textContent = "{{ __('messages.dashboard.web.service.form.placeholders.icon') }}"
            defaultIconOption.setAttribute('selected',true);
            defaultIconOption.setAttribute('disabled',true);

            IconSelect.appendChild(defaultIconOption); // Appends the <option> to the <select> element

            for (const item of IconsArray) {
                const newOption = document.createElement('option');
                newOption.value = item.value; // Assigns the "value" property from the transformed array
                newOption.textContent = item.content; // Sets the "content" property as the displayed text
                IconSelect.appendChild(newOption); // Appends the <option> to the <select> element
            }

            if(data && data.icon){
                IconSelect.value = data.icon;

                IconImagePreview.src = "/storage"+data.icon;
            }

            if(data && data.duration){
                DurationInput.value = data.duration;
            };

            StatusSelect.onchange = (event) => {
                updateTransportActiveState(index, event.target.value);
            };
        }

        // Function to delete a Transport Card
        function deleteTransportCard(card) {
            card.remove();
            updateTransportIndices();
        }

        function updateTransportActiveState(clickedIndex,status) {
            const transportCards = document.querySelectorAll('.step-track');

            transportCards.forEach((card, index) => {
                const icon = card.querySelector(`img[id="step-track-icon-${index}"]`);
                const statusInput = card.querySelector(`select[id^="transports[${index}]"][name*="[status]"]`);

                icon.classList.remove('border-gray-light');
                icon.classList.remove('border-primary');
                icon.classList.remove('border-primary-dark');

                if (index < clickedIndex) {
                    // Set status to ACTIVE for current and previous steps
                    statusInput.value = 'COMPLETED';

                    // Add border-primary class to the icon
                    icon.classList.add('border-primary');

                }else if(index == clickedIndex) {

                    if(status){
                        // Set status to ACTIVE for current and previous steps
                        statusInput.value = status;
                        if(status == 'PENDING'){
                            icon.classList.add('border-gray-light');
                        }else if(status == 'IN_TRANSIT'){
                            icon.classList.add('border-primary-dark');
                        }else{
                            icon.classList.add('border-primary');
                        }
                    }else{
                        statusInput.value = 'IN_TRANSIT';
                        icon.classList.add('border-primary-dark');
                    }

                }else {
                    // Set status to INACTIVE for the remaining steps
                    statusInput.value = 'PENDING';

                    // Remove border-primary class from the icon
                    icon.classList.add('border-gray-light');
                }
            });
        }

        // Function to update the indices of Transport Cards
        function updateTransportIndices() {
            const transportCards = transportsContainer.children;
            Array.from(transportCards).forEach((card, index) => {
                card.querySelectorAll("input, select, label, textarea").forEach(element => {
                    if (element.tagName.toLowerCase() === 'label') {
                        element.htmlFor = element.htmlFor.replace(/\[\d+\]/, `[${index}]`);
                    } else {
                      element.id = element.id.replace(/\[\d+\]/, `[${index}]`);
                      element.name = element.name.replace(/\[\d+\]/, `[${index}]`);
                    }
                });

                card.querySelector("p.step-track-correlative").innerText = `${index + 1}:`;

                // Update the onClick attribute of the step-track-icon
                const icon = card.querySelector('img[id^="step-track-icon-"]');
                icon.id = `step-track-icon-${index}`;
                icon.addEventListener("click", function(){
                    updateTransportActiveState(index);
                });

                const title = card.querySelector('label[id^="step-track-label-"]');
                title.id = `step-track-label-${index}`;



                const containerContent = card.querySelector(`div[class^="transports-wrapper-content-"]`);
                containerContent.id = `transports-wrapper-content-${index}`;

                // Update the ID of the delete button
                const deleteButton = card.querySelector('button[id^="delete_transport_btn_"]');
                deleteButton.id = `delete_transport_btn_${index}`;

                const  toggleButtonUp = card.querySelector('span[id^="toogle_up_wrap_content_transport_btn_"]');
                toggleButtonUp.id = `toogle_up_wrap_content_transport_btn_${index}`;

                const toggleButtonDown = card.querySelector('span[id^="toogle_down_wrap_content_transport_btn_"]');

                toggleButtonDown.id = `toogle_down_wrap_content_transport_btn_${index}`;

            });

        }

        function searchClientsForOrders() {
            const clientIdInput = document.getElementById('client_id');
            const clientInput = document.getElementById('client_name');
            const clientList = document.getElementById('client_list');
            const clientListLoader = document.getElementById('client_list_loader');

            // Hide the list if clicked outside
            document.addEventListener('click', function (e) {
                if (!clientInput.contains(e.target) && !clientList.contains(e.target)) {
                    clientList.classList.add('hidden');
                    clientListLoader.classList.add('hidden');
                }
            });

            clientInput.addEventListener('input', function () {
                const query = clientInput.value.trim();
                clientList.classList.remove('hidden');
                clientListLoader.classList.remove('hidden');

                fetch(`/dashboard/clients/search?company=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Remove only the <li> elements inside the clientList
                        const listItems = clientList.querySelectorAll('li');
                        listItems.forEach(li => li.remove());

                        if (data.length > 0) {

                            data.forEach(client => {
                                const listItem = document.createElement('li');
                                listItem.textContent = `${client.company}`;
                                listItem.classList.add(
                                    'w-full',
                                    'h-auto',
                                    'text-body',
                                    'font-bold',
                                    'hover:bg-primary',
                                    'hover:text-white',
                                    'p-2',
                                    'cursor-pointer'
                                );

                                // On click, populate client_name and client_id, then hide the list
                                listItem.addEventListener('click', function () {
                                    clientInput.value = client.company; // Set client name
                                    clientIdInput.value = client.id; // Set client ID
                                    clientList.classList.add('hidden'); // Hide the list
                                });

                                clientList.appendChild(listItem);
                            });
                        } else {

                            const listItem = document.createElement('li');
                            listItem.textContent = `No clients found`;
                            listItem.classList.add(
                                'w-full',
                                'h-auto',
                                'text-body',
                                'font-bold',
                                'hover:bg-primary',
                                'hover:text-white',
                                'p-2',
                                'cursor-pointer'
                            );

                            clientList.appendChild(listItem);
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                        const listItem = document.createElement('li');
                        listItem.textContent = `Error fetching clients`;
                        listItem.classList.add(
                            'w-full',
                            'h-auto',
                            'text-body',
                            'font-bold',
                            'hover:bg-primary',
                            'hover:text-white',
                            'p-2',
                            'cursor-pointer'
                        );

                        clientList.appendChild(listItem);
                    })
                    .finally(()=>{
                        clientListLoader.classList.add('hidden');
                    });

            });
        }

        let CountriesData = [];
        let CitiesData = [];

        async function fetchAndPopulateCountries(OrderId) {
            try {
                // Select all transport country dropdowns
                const countrySelects = document.querySelectorAll('[id^="transports["][id$="country]"]');

                const order = OrdersData.find((item) => item.id == Number(OrderId) )

                countrySelects.forEach(async (selectInput) => {

                    const index = selectInput.id.match(/\[([^\]]+)\]/)?.[1]; // Extract the index from the ID

                    await attachCountriesOptions(selectInput);

                    if (index) {

                        selectInput.value = order.tracking_steps[index].country;

                        const citySelect = document.querySelector(`[id="transports[${index}][city]"]`);

                        // Add event listener to load cities based on selected country
                        selectInput.addEventListener('change', function(event) {

                            selectInput.value = event.target.value;

                            if (citySelect) {
                                loadCities(event.target.value,selectInput, citySelect);
                            }

                        });


                        if(order.tracking_steps[index].country){

                            await loadCities(order.tracking_steps[index].country,selectInput,citySelect);

                        }

                        const LattitudeInput = document.querySelector(`[id="transports[${index}][lat]"]`);
                        const LongitudeInput = document.querySelector(`[id="transports[${index}][lng]"]`);

                        citySelect.value = order.tracking_steps[index].city;
                        LattitudeInput.value = order.tracking_steps[index].lat;
                        LongitudeInput.value = order.tracking_steps[index].lng;
                    }

                });
            } catch (error) {
                console.error('Error fetching country data:', error);
            }
        }

        async function attachCountriesOptions(selectCountryInput){

            if(CountriesData.length > 0){
                // Clear existing options except the placeholder
                selectCountryInput.innerHTML = '<option value="">{{ __("messages.dashboard.tracking_step.form.placeholders.country") }}</option>';

                // Append country names to each select input
                for (const country of CountriesData) {
                    const option = document.createElement('option');
                    option.value = country.name;
                    option.textContent = country.name;
                    option.setAttribute('data-code', country.code);
                    selectCountryInput.appendChild(option);
                }
            }
        }


        async function loadCities(country,countrySelect, citySelect) {
            try {
                // Find the option in the countrySelect that matches the country parameter
                for (let i = 0; i < countrySelect.options.length; i++) {
                    const option = countrySelect.options[i];

                    // Assuming 'country' is the country code, and the value attribute of each option is the country code
                    if (option.value === country) {
                        countrySelect.selectedIndex = i; // Select the matching option
                        break;
                    }
                }

                // Get the selected country option
                const selectedOption = countrySelect.options[countrySelect.selectedIndex];

                // Get the data-code attribute from the selected option
                const countryCode = selectedOption.getAttribute('data-code');



                // Fetch cities from the server
                const response = await fetch(`/dashboard/order/search-cities?country=${encodeURIComponent(countryCode)}`);


                if (!response.ok) {
                    throw new Error(`Error fetching cities: ${response.statusText}`);
                }

                // Parse the JSON response
                CitiesData = await response.json();


                if (CitiesData.length > 0 ) {

                    // Clear existing city options
                    citySelect.innerHTML = '<option value="">{{ __("messages.dashboard.tracking_step.form.placeholders.city") }}</option>';

                    for (const city of CitiesData) {
                        const option = document.createElement('option');
                        option.classList.add('city');
                        option.value = city.name;
                        option.textContent = city.name;
                        option.setAttribute('data-lat', city.lat);
                        option.setAttribute('data-lng', city.lng);
                        citySelect.appendChild(option);
                    }
                }
            } catch (error) {
                console.error('Error loading cities:', error);
            }
        }

        async function AddEventSelectCity(citySelect,latitudeInput,longitudeInput) {
            const index = citySelect.id.match(/\[([^\]]+)\]/)?.[1]; // Extract the index from the ID

            if (index) {
                citySelect.addEventListener('change', function(event) {
                    const selectedCityOption = citySelect.options[citySelect.selectedIndex];

                    // Ensure the selected city option exists
                    if (selectedCityOption && latitudeInput && longitudeInput) {
                        // Update the latitude and longitude based on the selected city
                        latitudeInput.value = selectedCityOption.getAttribute('data-lat') || '';
                        longitudeInput.value = selectedCityOption.getAttribute('data-lng') || '';
                    }
                });
            }
        }

        function toggleTransportContent(downButtonId, upButtonId, containerClass) {
            const downButton = document.getElementById(downButtonId);
            const upButton = document.getElementById(upButtonId);
            const container = document.querySelector(`.${containerClass}`);

            if (!downButton || !upButton || !container) {
                console.error("One or more elements are missing. Ensure correct IDs and class are passed.");
                return;
            }

            function toggleButtons() {
                if (downButton.classList.contains("hidden")) {
                    downButton.classList.remove("hidden");
                    upButton.classList.add("hidden");
                } else {
                    downButton.classList.add("hidden");
                    upButton.classList.remove("hidden");
                }
            }

            function toggleContainerHeight(button) {
                if (button === downButton) {
                    container.classList.add("h-auto");
                    container.classList.add("p-4");
                    container.classList.add("my-4");
                    container.classList.remove("hidden");
                    container.classList.remove("h-[0]");
                    container.classList.remove("opacity-0");
                } else if (button === upButton) {
                    container.classList.remove("h-auto");
                    container.classList.remove("my-4");
                    container.classList.remove("p-4");
                    container.classList.add("hidden");
                    container.classList.add("h-[0]");
                    container.classList.add("opacity-0");
                }
            }

            downButton.addEventListener("click", () => {
                toggleButtons();
                toggleContainerHeight(downButton);
            });

            upButton.addEventListener("click", () => {
                toggleButtons();
                toggleContainerHeight(upButton);
            });
        }

        function initializeWrapperScroller() {
            const containers = document.querySelectorAll("[class*='transports-wrapper-content-']");
            containers.forEach((container) => {
                // Extract the dynamic index from the container's class
                const containerClasses = Array.from(container.classList);
                const dynamicClass = containerClasses.find((cls) => cls.startsWith("transports-wrapper-content-"));
                if (!dynamicClass) return;

                const index = dynamicClass.split("-").pop(); // Extract the index
                const downButtonId = `toogle_down_wrap_content_transport_btn_${index}`;
                const upButtonId = `toogle_up_wrap_content_transport_btn_${index}`;

                toggleTransportContent(downButtonId, upButtonId, dynamicClass);
            });
        }

        function AddHandlerUpdateTrackIcon(selectElement,index){
            // Get the selected value (icon URL)
            const selectedIcon = selectElement.value;

            // Find the corresponding image element using the index
            const imgElement = document.getElementById(`step-track-icon-${index}`);

            // Update the image source if the image element exists
            if (imgElement) {
                imgElement.src = `/storage/${selectedIcon}`; // Update this path as needed
            }
        }

        function AddHandlerUpdateTrackName(inputElement, index){
            // Get the new value of the input field
            const newValue = inputElement.value;

            // Find the corresponding label using the index
            const label = document.getElementById(`step-track-label-${index}`);

            // Update the label's text content
            if (label) {
                label.textContent = newValue;
            }
        }

        function initializeTransportInputs() {
            // Select all input fields with a name pattern matching "transports[INDEX][name]"
            const inputs = document.querySelectorAll('input[name^="transports["][name$="[name]"]');

            // Loop through each input and add an onchange event listener
            inputs.forEach(input => {
                // Extract the index from the input's name attribute using a regex
                const match = input.name.match(/transports\[(\d+)\]\[name\]/);
                if (match) {
                    const index = match[1]; // The extracted index from the name attribute

                    // Add an onchange event listener to the input
                    input.addEventListener('input', function () {
                        AddHandlerUpdateTrackName(input, index);
                    });
                }
            });
        }

        let OrdersData = [];
        let IconsData = [];


        @if($EntityType == "order")
            OrdersData = {!! json_encode($pagination->items()) !!};
            CountriesData = {!! json_encode($countries) !!};
            IconsData = {!!  json_encode($icons) !!};
        @endif


        let IconsArray = Object.entries(IconsData).map(([key, value]) => ({
            value: value,
            content: key
        }));


        const DefaultTransportOptions = {
            ship:[
                {
                    name:"Proveedor",
                    icon:"/images/svgs/warehouse.svg",
                    country:"China",
                    country_code:"CN",
                    city:"Shanghai",
                    lat: 31.2286,
                    lng: 121.4747,
                    address:"Direccion del Proveedor",
                    type:"LAND",
                    status:"PENDING",
                    extref:"",
                    duration: 1,
                    description:"Proveedor"
                },
                {
                    name:"Puerto Origen",
                    icon:"/images/svgs/ship.svg",
                    country:"China",
                    country_code:"CN",
                    city:"Shanghai",
                    lat: 31.2286,
                    lng: 121.4747,
                    address:"Direccion del puerto",
                    type:"SHIP",
                    status:"PENDING",
                    extref:"",
                    duration: 2,
                    description:"Puerto Origen"
                },
                {
                    name:"Puerto Destino",
                    icon:"/images/svgs/anchor.svg",
                    country:"Peru",
                    country_code:"PE",
                    city:"Callao",
                    lat: -12.0522,
                    lng: -77.1392,
                    address:"Direccion del Puerto del Callao",
                    type:"SHIP",
                    status:"PENDING",
                    extref:"",
                    duration: 30,
                    description:"Puerto Destino"
                },
                {
                    name:"Aduanas Peru",
                    icon:"/images/svgs/truck.svg",
                    country:"Peru",
                    country_code:"PE",
                    city:"Callao",
                    lat: -12.0522,
                    lng: -77.1392,
                    address:"Direccion de Aduanas",
                    type:"LAND",
                    status:"PENDING",
                    extref:"",
                    duration: 1,
                    description:"Aduanas Peru"
                },
                {
                    name:"Destino Cliente",
                    icon:"/images/svgs/house.svg",
                    country:"Peru",
                    country_code:"PE",
                    city:"Lima",
                    lat: -12.06,
                    lng: -77.0375,
                    address:"Direccion del cliente",
                    type:"LAND",
                    status:"PENDING",
                    extref:"",
                    duration: 5,
                    description:"Destino Cliente"
                }
            ],
            air:[
                {
                    name:"Proveedor",
                    icon:"/images/svgs/warehouse.svg",
                    country:"China",
                    country_code:"CN",
                    city:"Shanghai",
                    lat: 31.2286,
                    lng: 121.4747,
                    address:"Direccion del Proveedor",
                    type:"LAND",
                    status:"PENDING",
                    extref:"",
                    duration: 1,
                    description:"Proveedor"
                },
                {
                    name:"Aeropuerto Origen",
                    icon:"/images/svgs/plane-takeoff.svg",
                    country:"China",
                    country_code:"CN",
                    city:"Shanghai",
                    lat: 31.2286,
                    lng: 121.4747,
                    address:"Direccion del Aeropuerto Origen",
                    type:"AIR",
                    status:"PENDING",
                    extref:"",
                    duration: 2,
                    description:"Puerto Origen"
                },
                {
                    name:"Aeropuerto Destino",
                    icon:"/images/svgs/plane-landing.svg",
                    country:"Peru",
                    country_code:"PE",
                    city:"Callao",
                    lat: -12.0522,
                    lng: -77.1392,
                    address:"Aeropuerto Internacional Jorge Chavez",
                    type:"AIR",
                    status:"PENDING",
                    extref:"",
                    duration: 30,
                    description:"Aeropuerto Destino - Aeropuerto Internacional Jorge Chavez"
                },
                {
                    name:"Aduanas Peru",
                    icon:"/images/svgs/truck.svg",
                    country:"Peru",
                    country_code:"PE",
                    city:"Callao",
                    lat: -12.0522,
                    lng: -77.1392,
                    address:"Aduanas - Aeropuerto Internacional Jorge Chavez",
                    type:"LAND",
                    status:"PENDING",
                    extref:"",
                    duration: 1,
                    description:"Aduanas Peru"
                },
                {
                    name:"Destino Cliente",
                    icon:"/images/svgs/house.svg",
                    country:"Peru",
                    country_code:"PE",
                    city:"Lima",
                    lat: -12.06,
                    lng: -77.0375,
                    address:"Direccion del Cliente",
                    type:"LAND",
                    status:"PENDING",
                    extref:"",
                    duration: 5,
                    description:"Destino Cliente"
                }
            ],
            land:[
                {
                    name:"Proveedor",
                    icon:"/images/svgs/warehouse.svg",
                    country:"Peru",
                    city:"Arequipa",
                    country_code:"PE",
                    address:"Direccion del Proveedor",
                    lat: -16.4,
                    lng: -71.5333,
                    type:"LAND",
                    status:"PENDING",
                    extref:"",
                    duration: 1,
                    description:"Proveedor"
                },
                {
                    name:"Destino Cliente",
                    icon:"/images/svgs/house.svg",
                    country:"Peru",
                    city:"Lima",
                    country_code:"PE",
                    lat: -12.06,
                    lng: -77.0375,
                    address:"Direccion del Cliente",
                    type:"LAND",
                    status:"PENDING",
                    extref:"",
                    duration: 7,
                    description:"Destino Cliente"
                }
            ]
        }

        function generateDefaultTransportOptions(type) {
            let selectedOptions;

            switch (type) {
                case "ship":
                    selectedOptions = DefaultTransportOptions.ship;
                    break;

                case "air":
                    selectedOptions = DefaultTransportOptions.air;
                    break;

                default:
                    selectedOptions = DefaultTransportOptions.land;
                    break;
            }

            for(let option of selectedOptions){
                addTransportCard(option);
            }
        }


        function loadOrderFunction(OrderId){
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

            const generateDefaultAirTransport = document.getElementById('default_air_transport_btn');

            generateDefaultAirTransport.addEventListener("click", function(){
                generateDefaultTransportOptions("air");
            });

            const generateDefaultShipTransport = document.getElementById('default_ship_transport_btn');

            generateDefaultShipTransport.addEventListener("click", function(){
                generateDefaultTransportOptions("ship");
            });

            const generateDefaultLandTransport = document.getElementById('default_land_transport_btn');

            generateDefaultLandTransport.addEventListener("click", function(){
                generateDefaultTransportOptions("land");
            });

            //Attach Image update for the selected Icon for the tracking step
            attachIconImageUpdates(OrderId);

            // Initialize drag and drop for .step-tracks and .step-track
            initializeDragAndDrop(".step-tracks", "step-track");

            //attach the Seach method
            searchClientsForOrders();

            //fetch and Populate Countries Select
            fetchAndPopulateCountries(OrderId);

            //addHandlerUpdateTitle
            initializeTransportInputs();

            initializeWrapperScroller();

        }

        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById("modal_status_component");

            if (modal) {
                const emailNotification = modal.querySelector("#email-notification");
                const titlePdfArchive = modal.querySelector('#file_title_modal');
                const pdfArchive = modal.querySelector('#pdf-archive');

                if (emailNotification) {
                    emailNotification.addEventListener('change', function () {
                        if (emailNotification.checked) {
                            titlePdfArchive.classList.remove('hidden');
                            pdfArchive.classList.remove('hidden');
                            pdfArchive.disabled = false;
                        } else {
                            titlePdfArchive.classList.add('hidden');
                            pdfArchive.classList.add('hidden');
                            pdfArchive.disabled = true;
                        }
                        // Clear the file input value
                        if (pdfArchive) {
                            pdfArchive.value = '';
                        }
                    });
                }
            }
        });



    </script>
@endpush
