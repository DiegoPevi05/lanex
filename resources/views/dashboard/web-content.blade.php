@extends('layouts.dashboard')

@section('content-dashboard')

    <section id="dashboard_web_{{$EntityType}}" class="bg-gray-light h-full w-full flex flex-row xl:gap-x-4 p-4">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="w-full h-full flex flex-col bg-white rounded-xl p-4 gap-y-2">
            <div class="w-full h-auto flex flex-row justify-between py-4">
                <div class="w-auto h-auto flex flex-row items-center gap-x-2">
                    <a href="{{ route('dashboard_web') }}" class="h-10 w-10 bg-transparent bg-white rounded-full hover:bg-primary hover:text-white cursor-pointer border-2 border-primary active:scale-95 flex items-center justify-center text-secondary-dark p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                    <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1">
                        @if($EntityType == "product")
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-2"><path d="M3 9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9Z"/><path d="m3 9 2.45-4.9A2 2 0 0 1 7.24 3h9.52a2 2 0 0 1 1.8 1.1L21 9"/><path d="M12 3v6"/></svg>

                        @elseif($EntityType == "supplier")
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-warehouse"><path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"/><path d="M6 18h12"/><path d="M6 14h12"/><rect width="12" height="12" x="6" y="10"/></svg>
                        @elseif($EntityType == "service")
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        @elseif($EntityType == "blog")
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        @endif
                    </span>
                    <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.web.'.$EntityType.'.header') }}</h4>
                </div>

                <div class="w-auto h-auto flex flex-row">
                    <button id="create_button" class="w-auto h-full px-4 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2">
                        {{__('messages.dashboard.web.'.$EntityType.'.new_entity')}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    </button>
                </div>
            </div>

            <x-search-bar
                id='web-content-{{$EntityType}}-search'
                dropDownId="dashboard-web-{{$EntityType}}-search-bar"
                :currentDropDownOption="$currentFilter"
                :dropDownOptions="$filters"
                placeholderInput='messages.dashboard.web.{{$EntityType}}.input_placeholder_search'
                labelButton='messages.dashboard.web.{{$EntityType}}.button_label_search'
            />
            <div class="w-full flex flex-col overflow-y-scroll no-scroll-bar">
                <div class="w-full flex flex-col gap-y-2">
                    @foreach ($pagination->items() as $paginate)
                        <x-web-content-card
                            :data="$paginate"
                        />
                    @endforeach
                </div>
            </div>
            <div class="w-full h-auto flex flex-row justify-between mt-auto">
                <div class="w-auto flex flex-row gap-x-1">
                    <a href="{{route('dashboard_web_'.$EntityType,['page' => 1 ] )}}" class="{{$pagination->currentPage() == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center   duration-300 cursor-pointer  p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                    </a>

                    <a href="{{ route('dashboard_web_'.$EntityType, ['page' =>$pagination->currentPage() - 1]) }}" class="{{$pagination->currentPage() == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                </div>

                <div class="w-auto flex flex-row gap-x-1">
                    <a  href="{{ route('dashboard_web_'.$EntityType, ['page' =>$pagination->currentPage() + 1]) }}" class="{{$pagination->lastPage() == $pagination->currentPage() ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full"><path d="m9 18 6-6-6-6"/></svg>
                    </a>

                    <a href="{{ route('dashboard_web_'.$EntityType, ['page' =>$pagination->lastPage()]) }}" class="{{$pagination->lastPage() == $pagination->currentPage() ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="dashboard_web_content_form max-xl:fixed max-xl:top-0 max-xl:bottom-0 max-sm:-right-[100%] max-xl:-right-[600px] w-full  sm:w-[600px] max-xl:border-s-2 xl:w-[50%] h-full bg-white rounded-xl flex flex-col items-center justify-center p-4 transition-all duration-300">
            <div class="w-full h-auto flex flex-row justify-end px-4 xl:hidden absolute top-4 right-4 z-[1200]">
                <span class="dashboard_button_toggle_content h-12 w-12 flex items-center justify-center border-2 border-gray-light rounded-xl cursor-pointer hover:bg-primary-dark text-white bg-secondary-dark duration-300 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </span>
            </div>
            <div id="empty-content-form" class="w-auto h-auto flex flex-col items-center justify-center">
                <img src="/storage/images/web/empty.svg" alt="empty_logo" class="w-[40%] h-auto"/>
                <label>{{__('messages.dashboard.web.empty_content')}}</label>
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

        function clearContent() {
            toggleFormContent();
            const currentPage = document.querySelector('#dashboard_web_{{$EntityType}}');
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



            const SearchBar = document.querySelector(`#web-content-{{$EntityType}}-search`);
            // Listen for the custom event
            SearchBar.addEventListener('search-web-content-{{$EntityType}}-search', function (e) {

                const key = e.detail.key; // Get the selected value
                const value = e.detail.value; // Get the selected value
                // Construct the new route
                const newRoute = `/dashboard/web/{{$EntityType}}?page=1&filterKey=${key}&filterValue=${value}`;

                // Navigate to the new route
                window.location.href = newRoute;
            });



            function updateFormState(idEntity, typeEntity,formRequest){

                toggleFormContent();

                const currentPage = document.querySelector('#dashboard_web_{{$EntityType}}');
                const contentForm  = currentPage.querySelector('#content-form');
                const emtpyContentForm = currentPage.querySelector('#empty-content-form')
                const loadingContentForm = currentPage.querySelector('#loading-content-form')

                if (!contentForm.classList.contains('hidden')) {
                    contentForm.classList.add('hidden');
                };

                emtpyContentForm.classList.add('hidden');
                loadingContentForm.classList.remove('hidden');

                // Update content dynamically via AJAX using POST
                fetch('/dashboard/web/{{$EntityType}}/form', {
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

                    if(typeEntity == "service"){
                        // Attach the event listener for the select and image
                        attachIconImageUpdate();
                    }

                    if(typeEntity == "blog"){
                        const addBlogContentButton = currentPage.querySelector('#add-blog-content-button');
                        addBlogContentButton.addEventListener('click', function(e){
                            addBlogContentFromInput();
                        });

                        const addTagButton = currentPage.querySelector('#add-tag-button');
                        addTagButton.addEventListener('click', function(e){
                            addTagFromInput();
                        });
                    }

                    @if(session()->has('_old_input'))
                        const oldInputs = @json(session('_old_input'));

                        for (const [field, value] of Object.entries(oldInputs)) {

                            let form = null;

                            if(typeEntity == "service"){
                                form = document.querySelector('#service-form');
                            }else if(typeEntity == "supplier"){
                                form = document.querySelector('#supplier-form');
                            }else if(typeEntity == "product"){
                                form = document.querySelector('#product-form');
                            }else if(typeEntity == "blog"){
                                form = document.querySelector('#blog-form');
                            }

                            const inputField = form.querySelector(`[name="${field}"]`);
                            if (inputField) {
                                // Handle different input types
                                if (inputField.type === "checkbox" || inputField.type === "radio") {
                                    inputField.checked = inputField.value == value;
                                } else {
                                    inputField.value = value;
                                }
                            }
                        }
                        fillCustomFields(typeEntity,oldInputs);

                    @endif

                     // Check for errors and populate error messages
                    @if(session('errors'))
                        const errors = @json(session('errors')->toArray());

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


            document.addEventListener('web-content-card-{{$EntityType}}', function (e) {
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
            const event = new CustomEvent('web-content-card-{{$EntityType}}', {
                detail: { idEntity, typeEntity,formRequest }
            });

            // Dispatch the custom event
            document.dispatchEvent(event);
        }


    function fillCustomFields(typeEntity,oldInputs){

        if(typeEntity == "blog"){
            const blogContent = oldInputs['content'];


            if(blogContent){
                const blogContentContainer = document.getElementById('blog-content-container');
                blogContentContainer.innerHTML = '';

                blogContent.forEach((content,index) => {
                    createBlogContentItem(content.header, content.content);
                });
            }

            const tags = oldInputs['tags'];

            if(tags){
                const tagsContainer = document.getElementById('tags-container');
                tagsContainer.innerHTML = '';

                tags.forEach((tag,index) => {
                    createTagItem(tag);
                });
            }
        }

    }





    let pointIndex = 0;


    function addPoint() {

        pointIndex = document.querySelectorAll("#points-container .point-item").length;
        // Create a new div to hold the point inputs
        const pointContainer = document.createElement("div");
        pointContainer.classList.add("point-item", "mb-4", "mt-4", "border-2","border-secondary-dark","flex","flex-col", "rounded-md","p-4","animation-element","in-view","slide-in-up");

        const containerHeader = document.createElement('div');
        containerHeader.classList.add('flex','flex-row','justify-between','w-full', 'h-auto')

        const pointTitle = document.createElement("p");
        pointTitle.classList.add("text-sm", "font-bold", "text-primary", "capitalize");
        pointTitle.innerText = `{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_point')}} ${pointIndex + 1}`;
        containerHeader.appendChild(pointTitle);

        const deleteButton = document.createElement("button");
        deleteButton.classList.add("text-sm", "font-bold", "text-primary", "capitalize","rounded-xl","active:scale-95","duration-300","transition-all","bg-secondary-dark","hover:bg-primary","px-4", "py-2","text-white");
        deleteButton.innerText = "{{ __('messages.common.delete') }}";

        // Add delete functionality
        deleteButton.onclick = function() {
            pointContainer.remove(); // Remove the point container
            updatePointTitles(); // Update the titles of remaining points
        };

        containerHeader.appendChild(deleteButton);
        pointContainer.appendChild(containerHeader);

        // Set up the title input
        const titleLabel = document.createElement("label");
        titleLabel.classList.add("block", "text-sm", "font-bold", "text-secondary-dark", "capitalize");
        titleLabel.innerText = `{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points_point_title')}}`;
        pointContainer.appendChild(titleLabel);

        const titleInput = document.createElement("input");
        titleInput.type = "text";
        titleInput.name = `webcontent[keypoints][points][${pointIndex}][title]`;
        titleInput.classList.add("mt-2","text-sm","block", "w-full", "p-2", "border-b-2", "border-b-secondary-dark", "bg-white", "focus:border-b-primary", "focus:outline-none", "text-body");
        titleInput.placeholder = "Enter point title";
        pointContainer.appendChild(titleInput);

        // Set up the content textarea
        const contentLabel = document.createElement("label");
        contentLabel.classList.add("block", "text-sm", "font-bold", "text-secondary-dark", "capitalize", "mt-2");
        contentLabel.innerText = `{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points_point_content')}}`;
        pointContainer.appendChild(contentLabel);

        const contentTextarea = document.createElement("textarea");
        contentTextarea.name = `webcontent[keypoints][points][${pointIndex}][content]`;
        contentTextarea.classList.add("mt-2","text-sm", "block", "w-full", "p-2", "border-b-2", "border-b-secondary-dark", "bg-white", "focus:border-b-primary", "focus:outline-none", "text-body","!h-[150px]","no-scroll-bar");
        contentTextarea.placeholder = "Enter point content";
        pointContainer.appendChild(contentTextarea);

        // Append the new point container to the main container
        document.getElementById("points-container").appendChild(pointContainer);

        // Increment the point index for the next point
        pointIndex++;
    }

    // Helper function to update point titles after deletion
    function updatePointTitles() {
        const pointItems = document.querySelectorAll(".point-item");
        pointItems.forEach((item, index) => {
            // Update point title display
            const pointTitle = item.querySelector("p");
            pointTitle.innerText = `Point ${index + 1}`;

            // Update input names to have continuous indexing
            const titleInput = item.querySelector("input[type='text']");
            const contentTextarea = item.querySelector("textarea");

            titleInput.name = `webcontent[keypoints][points][${index}][title]`;
            contentTextarea.name = `webcontent[keypoints][points][${index}][content]`;
        });

        // Update pointIndex to the current count
        pointIndex = pointItems.length;
    }

    let questionIndex = 0;


    function addQuestion(prefix) {
        questionIndex = document.querySelectorAll("#questions-container .question-item").length;
        // Create a new div to hold the point inputs
        const pointContainer = document.createElement("div");
        pointContainer.classList.add("question-item", "mb-4", "mt-4", "border-2","border-secondary-dark","flex","flex-col", "rounded-md","p-4","animation-element","in-view","slide-in-up");

        const containerHeader = document.createElement('div');
        containerHeader.classList.add('flex','flex-row','justify-between','w-full', 'h-auto')

        const pointTitle = document.createElement("p");
        pointTitle.classList.add("text-sm", "font-bold", "text-primary", "capitalize");
        pointTitle.innerText = `{{__('messages.dashboard.web.service.form.fields.webcontent_faqs_question')}} ${questionIndex + 1}`;
        containerHeader.appendChild(pointTitle);

        const deleteButton = document.createElement("button");
        deleteButton.classList.add("text-sm", "font-bold", "text-primary", "capitalize","rounded-xl","active:scale-95","duration-300","transition-all","bg-secondary-dark","hover:bg-primary","px-4", "py-2","text-white");
        deleteButton.innerText = "{{ __('messages.common.delete') }}";

        // Add delete functionality
        deleteButton.onclick = function() {
            pointContainer.remove(); // Remove the point container
            updateQuestionTitles(prefix); // Update the titles of remaining points
        };

        containerHeader.appendChild(deleteButton);
        pointContainer.appendChild(containerHeader);

        // Set up the title input
        const titleLabel = document.createElement("label");
        titleLabel.classList.add("block", "text-sm", "font-bold", "text-secondary-dark", "capitalize");
        titleLabel.innerText = `{{__('messages.dashboard.web.service.form.fields.webcontent_faqs_question_question')}}`;
        pointContainer.appendChild(titleLabel);

        const titleInput = document.createElement("input");
        titleInput.type = "text";
        titleInput.name = `${prefix}[${questionIndex}][question]`;
        titleInput.classList.add("mt-2","text-sm","block", "w-full", "p-2", "border-b-2", "border-b-secondary-dark", "bg-white", "focus:border-b-primary", "focus:outline-none", "text-body");
        titleInput.placeholder = "Enter question title";
        pointContainer.appendChild(titleInput);

        // Set up the content textarea
        const contentLabel = document.createElement("label");
        contentLabel.classList.add("block", "text-sm", "font-bold", "text-secondary-dark", "capitalize", "mt-2");
        contentLabel.innerText = `{{__('messages.dashboard.web.service.form.fields.webcontent_faqs_question_answer')}}`;
        pointContainer.appendChild(contentLabel);

        const contentTextarea = document.createElement("textarea");
        contentTextarea.name = `${prefix}[${questionIndex}][answer]`;
        contentTextarea.classList.add("mt-2","text-sm", "block", "w-full", "p-2", "border-b-2", "border-b-secondary-dark", "bg-white", "focus:border-b-primary", "focus:outline-none", "text-body","!h-[150px]","no-scroll-bar");
        contentTextarea.placeholder = "Enter question";
        pointContainer.appendChild(contentTextarea);

        // Append the new point container to the main container
        document.getElementById("questions-container").appendChild(pointContainer);

        // Increment the point index for the next point
        questionIndex++;
    }

    // Helper function to update point titles after deletion
    function updateQuestionTitles(prefix) {
        const questionItems = document.querySelectorAll(".question-item");
        questionItems.forEach((item, index) => {
            // Update point title display
            const pointTitle = item.querySelector("p");
            pointTitle.innerText = `Question ${index + 1}`;

            // Update input names to have continuous indexing
            const titleInput = item.querySelector("input[type='text']");
            const contentTextarea = item.querySelector("textarea");

            titleInput.name = `${prefix}[${index}][question]`;
            contentTextarea.name = `${prefix}[${index}][answer]`;
        });

        // Update questionIndex to the current count
        questionIndex = questionItems.length;
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



    let detailIndex = 0;


    function addDetail() {

        detailIndex = document.querySelectorAll("#details-container .detail-item").length;
        // Create a new div to hold the detail inputs
        const detailContainer = document.createElement("div");
        detailContainer.classList.add("detail-item", "mb-4", "mt-4", "border-2","border-secondary-dark","flex","flex-col", "rounded-md","p-4","animation-element","in-view","slide-in-up");

        const containerHeader = document.createElement('div');
        containerHeader.classList.add('flex','flex-row','justify-between','w-full', 'h-auto')

        const detailTitle = document.createElement("p");
        detailTitle.classList.add("text-sm", "font-bold", "text-primary", "capitalize");
        detailTitle.innerText = `{{__('messages.dashboard.web.supplier.form.fields.details_detail')}} ${detailIndex + 1}`;
        containerHeader.appendChild(detailTitle);

        const deleteButton = document.createElement("button");
        deleteButton.classList.add("text-sm", "font-bold", "text-primary", "capitalize","rounded-xl","active:scale-95","duration-300","transition-all","bg-secondary-dark","hover:bg-primary","px-4", "py-2","text-white");
        deleteButton.innerText = "{{ __('messages.common.delete') }}";

        // Add delete functionality
        deleteButton.onclick = function() {
            detailContainer.remove(); // Remove the detail container
            updateDetailTitles(); // Update the titles of remaining details
        };

        containerHeader.appendChild(deleteButton);
        detailContainer.appendChild(containerHeader);


        const detailTextarea = document.createElement("textarea");
        detailTextarea.name = `details[${questionIndex}]`;
        detailTextarea.classList.add("mt-2","text-sm", "block", "w-full", "p-2", "border-b-2", "border-b-secondary-dark", "bg-white", "focus:border-b-primary", "focus:outline-none", "text-body","!h-[150px]","no-scroll-bar");
        detailTextarea.placeholder = "Enter detail";
        detailContainer.appendChild(detailTextarea);

        // Append the new detail container to the main container
        document.getElementById("details-container").appendChild(detailContainer);

        // Increment the detail index for the next detail
        detailIndex++;
    }

    // Helper function to update point titles after deletion
    function updateDetailTitles() {
        const datailItems = document.querySelectorAll(".detail-item");
        datailItems.forEach((item, index) => {
            // Update point title display
            const detailTitle = item.querySelector("p");
            detailTitle.innerText = `Detail ${index + 1}`;

            // Update input names to have continuous indexing
            const detailInput = item.querySelector("input[type='text']");

            detailInput.name = `details[${index}]`;
        });

        // Update detailIndex to the current count
        detailIndex = pointItems.length;
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

    function attachIconImageUpdate() {
        const iconSelect = document.getElementById('icon');
        const iconImage = document.getElementById('icon-image');

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
        const iconSelect = document.getElementById('icon');
        const iconImage = document.getElementById('icon-image');

        // Update the image source to the selected option or default to ambulance
        const selectedIcon = iconSelect.value;
        iconImage.src = selectedIcon ? '/storage'+selectedIcon : '/storage/images/svgs/ambulance.svg';
    }


    function addBlogContentFromInput(){
        const blogContentHeaderInput = document.getElementById('previewContentHeader');
        const blogContentBodyInput = document.getElementById('previewContentBody');

        if(!blogContentHeaderInput.value || !blogContentBodyInput.value){
            return;
        }

        createBlogContentItem(blogContentHeaderInput.value, blogContentBodyInput.value);
    }

    function deleteBlogContent(blogIndex){
        const blogContentItem = document.getElementById(`blog-content-item-${blogIndex}`);
        blogContentItem.remove();
    }

    function createBlogContentItem(title, content){
        const blogContentContainer = document.getElementById('blog-content-container');
        const blogIndex = blogContentContainer.querySelectorAll('.blog-content-item').length;

        const blogContentItem = document.createElement('div');
        blogContentItem.id = `blog-content-item-${blogIndex}`;
        blogContentItem.classList.add('blog-content-item','relative', 'w-full', 'flex', 'flex-col', 'justify-start', 'gap-x-2', 'border-2', 'border-gray-light', 'rounded-xl', 'p-4');

        const deleteButton = document.createElement('button');
        deleteButton.id = `blog-content-item-delete-button-${blogIndex}`;
        deleteButton.classList.add('w-8', 'h-8', 'top-1', 'right-1', 'absolute', 'p-1', 'bg-primary', 'text-white', 'duration-300', 'hover:bg-primary-dark', 'rounded-full', 'active:scale-95', 'capitalize');
        deleteButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x text"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        `;

        deleteButton.onclick = function() {
            deleteBlogContent(blogIndex);
        };

        blogContentItem.appendChild(deleteButton);

        const titleLabel = document.createElement('label');
        titleLabel.classList.add('block', 'text-sm', 'font-bold', 'text-secondary-dark', 'capitalize');
        titleLabel.innerText = title;
        blogContentItem.appendChild(titleLabel);

        const contentLabel = document.createElement('label');
        contentLabel.classList.add('block', 'text-sm', 'font-bold', 'text-secondary-dark', 'capitalize');
        contentLabel.innerText = content.substring(0, 100) + '...';
        blogContentItem.appendChild(contentLabel);

        const inputTitle = document.createElement('input');
        inputTitle.type = 'hidden';
        inputTitle.name = `content[${blogIndex}][header]`;
        inputTitle.value = title;
        blogContentItem.appendChild(inputTitle);

        const inputContent = document.createElement('input');
        inputContent.type = 'hidden';
        inputContent.name = `content[${blogIndex}][content]`;
        inputContent.value = content;
        blogContentItem.appendChild(inputContent);



        blogContentContainer.appendChild(blogContentItem);
    }


        function addTagFromInput(){
            const tagContentInput = document.getElementById('previewTag');

            if(!tagContentInput.value){
                return;
            }

            createTagItem(tagContentInput.value);
        }

        function deleteTag(tagIndex){
            const tagItem = document.getElementById(`tag-item-${tagIndex}`);
            tagItem.remove();
        }

        function createTagItem(tag){

            const tagsContainer = document.getElementById('tags-container');
            const tagIndex = tagsContainer.querySelectorAll('.tag-item').length;

            const tagItem = document.createElement('span');
            tagItem.id = `tag-item-${tagIndex}`;
            tagItem.classList.add('tag-item', 'flex', 'flex-row', 'w-fit', 'h-auto', 'items-center', 'px-3', 'py-1', 'bg-primary', 'text-white', 'rounded-full', 'gap-x-2');

            tagItem.innerHTML = `${tag}`


            const deleteButton = document.createElement('button');
            deleteButton.id = `tag-item-delete-button-${tagIndex}`;


            deleteButton.classList.add('w-6', 'h-6', 'p-1', 'bg-primary', 'text-white', 'duration-300', 'hover:bg-primary-dark', 'rounded-full', 'active:scale-95', 'capitalize');

            deleteButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x text"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            `;


            deleteButton.onclick = function() {
                deleteTag(tagIndex);
            };

            tagItem.appendChild(deleteButton);

            const inputTag = document.createElement('input');
            inputTag.type = 'hidden';
            inputTag.name = `tags[${tagIndex}]`;
            inputTag.value = tag;
            tagItem.appendChild(inputTag);

            tagsContainer.appendChild(tagItem);

        }


    </script>
@endpush
