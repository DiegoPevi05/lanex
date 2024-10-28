<div class="w-full h-full pe-2">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.web.service.form.headers.update") : __("messages.dashboard.web.service.form.headers.create")) : __("messages.dashboard.web.service.form.headers.view")  }}</h5>

    <form id="service-form"
      action="{{ $formRequest === 'create' ? route('services.store') : ($formRequest === 'update' ? route('services.update', $service->id) : '#') }}" enctype="multipart/form-data"
      method="POST">
        @csrf <!-- Include CSRF token for security -->

        @if($formRequest === 'update')
            @method('PUT') <!-- Specify PUT method for updating -->
        @endif
        <!-- Name Field -->
        <div class="mb-4 mt-4">
            <label for="name" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.name") }}</label>
            <input type="text" id="name" name="name" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('name', $service->name ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.name") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-name"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="icon" class="block text-sm font-bold text-secondary-dark capitalize">
                {{ __("messages.dashboard.web.service.form.fields.icon") }}
            </label>

            <select id="icon" name="icon" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" {{ $formRequest === "view" ? "disabled" : "" }}>
                <option value="" disabled selected>{{ __("messages.dashboard.web.service.form.placeholders.icon") }}</option>

                @foreach($icons as $filename => $content)
                    <option value="{{ $content }}" {{ old('icon', $service->icon ?? '') === $content ? 'selected' : '' }}>
                        {{ $filename }}
                    </option>
                @endforeach
            </select>

            <span class="text-primary font-bold text-xs error-message" id="error-icon"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="short_description" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.short_description") }}</label>
            <textarea id="short_description" name="short_description" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.short_description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old('short_description', $service->short_description ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-short_description"></span>
        </div>

        <label class="text-lg text-primary font-bold">{{ __("messages.dashboard.web.service.form.fields.webcontent") }}</label>

        <div class="mb-4 mt-4">
            <label for="webcontent[header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_header") }}</label>
            <input type="text" id="webcontent[header]" name="webcontent[header]" class="mt-2 text-sm block  w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.header", $service->webcontent['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_header") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_title") }}</label>
            <input type="text" id="webcontent[title]" name="webcontent[title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.title", $service->webcontent['title'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_title") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.title"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[description]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_description") }}</label>
            <textarea id="webcontent[description]" name="webcontent[description]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.description", $service->webcontent['description'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.description"></span>
        </div>


        <div class="mb-4 mt-4">
            <label for="webcontent[image]" class="block text-sm font-bold text-secondary-dark capitalize mb-4">{{ __("messages.dashboard.web.service.form.fields.webcontent_image") }}</label>
            <div class="flex flex-row justify-start gap-x-2">
                <div id="image-viewer-webcontent-image" class="h-[150px] w-[150px] border-2 border-gray-light rounded-xl bg-contain bg-no-repeat bg-center" style="background-image:url({{ $service ? asset('storage/' . $service->webcontent['image']) : '' }})">

                </div>
                <div class="file-select" id="src-tent-image" >
                  <input type="file" name="webcontent[image]" aria-label="webcontent[image]" onchange="previewImage(event, 'webcontent-image')" {{$formRequest === "view" ? "disabled" : ""}}/>
                </div>
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.image"></span>
        </div>



        <p class="text-lg text-primary font-bold mt-4">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview") }}</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_header") }}</label>
            <input id="webcontent[overview][header]" type="text" name="webcontent[overview][header]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.overview.header", $service->webcontent['overview']['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_header") }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_title") }}</label>
            <input id="webcontent[overview][title]" type="text" name="webcontent[overview][title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_title") }}" value="{{ old("webcontent.overview.title", $service->webcontent['overview']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.title"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][image]" class="block text-sm font-bold text-secondary-dark capitalize mb-4">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_image") }}</label>
            <div class="flex flex-row justify-start gap-x-2">
                <div id="image-viewer-webcontent-overview-image" class="h-[150px] w-[150px] border-2 border-gray-light rounded-xl bg-contain bg-no-repeat bg-center" style="background-image:url({{ $service ? asset('storage/' . $service->webcontent['overview']['image']) : '' }})">

                </div>
                <div class="file-select" id="src-tent-image" >
                  <input type="file" name="webcontent[overview][image]" aria-label="webcontent[overview][image]" onchange="previewImage(event, 'webcontent-overview-image')" {{$formRequest === "view" ? "disabled" : ""}}/>
                </div>
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][content][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_content_header") }}</label>
            <textarea id="webcontent[overview][content][header]" name="webcontent[overview][content][header]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_content_header") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.overview.content.header", $service->webcontent['overview']['content']['header'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][content][introduction]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_content_introduction") }}</label>
            <textarea id="webcontent[overview][content][introduction]" name="webcontent[overview][content][introduction]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_content_introduction") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.overview.content.introduction", $service->webcontent['overview']['content']['introduction'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content.introduction"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][content][content]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_content_content") }}</label>
            <textarea id="webcontent[overview][content][content]" name="webcontent[overview][content][content]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_content_content") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.overview.content.content", $service->webcontent['overview']['content']['content'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content.content"></span>
        </div>

        <p class="text-lg text-primary font-bold">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link") }}</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_header") }}</label>
            <input id="webcontent[content_link][header]" type="text" name="webcontent[content_link][header]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.content_link.header", $service->webcontent['content_link']['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_header") }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_title") }}</label>
            <input id="webcontent[content_link][title]" type="text" name="webcontent[content_link][title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_title") }}" value="{{ old("webcontent.content_link.title", $service->webcontent['content_link']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.title"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][button_label]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_button_label") }}</label>
            <input id="webcontent[content_link][button_label]" type="text" name="webcontent[content_link][button_label]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_button_label") }}" value="{{ old("webcontent.content_link.button_label", $service->webcontent['content_link']['button_label'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.button_label"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][content]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_content") }}</label>
            <textarea id="webcontent[content_link][content]" name="webcontent[content_link][content]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_content") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.content_link.content", $service->webcontent['content_link']['content'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.content"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][image]" class="block text-sm font-bold text-secondary-dark capitalize mb-4">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_image") }}</label>
            <div class="flex flex-row justify-start gap-x-2">
                <div id="image-viewer-webcontent-content-link-image" class="h-[150px] w-[150px] border-2 border-gray-light rounded-xl bg-contain bg-no-repeat bg-center" style="background-image:url({{ $service ? asset( 'storage/' . $service->webcontent['content_link']['image'] ) : '' }})">

                </div>
                <div class="file-select" id="src-tent-image" >
                  <input type="file" name="webcontent[content_link][image]" aria-label="webcontent[content_link][image]" onchange="previewImage(event, 'webcontent-content-link-image')" {{$formRequest === "view" ? "disabled" : ""}}/>
                </div>
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.content"></span>
        </div>


        <p class="text-lg text-primary font-bold mt-4">{{ __("messages.dashboard.web.service.form.fields.webcontent_keypoints_points") }}</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[keypoints][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_keypoints_header") }}</label>
            <input id="webcontent[keypoints][header]" type="text" name="webcontent[keypoints][header]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.keypoints.header", $service->webcontent['keypoints']['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_keypoints_header") }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.keypoints.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[keypoints][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_keypoints_title") }}</label>
            <input id="webcontent[keypoints][title]" type="text" name="webcontent[keypoints][title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_keypoints_title") }}" value="{{ old("webcontent.keypoints.title", $service->webcontent['keypoints']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.keypoints.title"></span>
        </div>

        <div class="my-4">
            <div class="w-full h-auto flex flex-row justify-between">
                <p class="text-sm text-primary font-bold">{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points')}}</p>
                <button type="button" class="hover:bg-white hover:text-primary active:scale-95 duration-300 border-2 border-primary bg-primary text-white px-4 py-2 rounded-xl ml-auto disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-100"  onclick="addPoint()" {{$formRequest === 'view' ? 'disabled' : ''}}>{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points_add')}}</button>
            </div>
            <!-- Container for dynamic points -->
            <div id="points-container" class="mb-4 mt-4">
                @if($service)
                    @foreach($service->webcontent['keypoints']['points'] as $index => $point)
                        <div class="point-item mb-4 mt-4 border-2 border-secondary-dark flex flex-col rounded-md p-4 animation-element in-view slide-in-up">
                            <div class="flex flex-row justify-between w-full h-auto">
                                <p class="text-sm font-bold text-primary capitalize">{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_point')}} {{ $index + 1 }}</p>
                                @if($formRequest !== 'view')
                                <button type="button" class="text-sm font-bold text-primary capitalize rounded-xl active:scale-95 duration-300 transition-all bg-secondary-dark hover:bg-primary px-4 py-2 text-white" onclick="this.closest('.point-item').remove(); updatePointTitles()">
                                    {{ __('messages.common.delete') }}
                                </button>
                                @endif
                            </div>

                            <label class="block text-sm font-bold text-secondary-dark capitalize mt-2">{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points_point_title')}}</label>
                            <input type="text" name="webcontent[keypoints][points][{{ $index }}][title]" value="{{ $point['title'] }}" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{__('messages.dashboard.web.service.form.placeholders.webcontent_keypoints_points_title')}}">

                            <label class="block text-sm font-bold text-secondary-dark capitalize mt-2">{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points_point_content')}}</label>
                            <textarea name="webcontent[keypoints][points][{{ $index }}][content]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{__('messages.dashboard.web.service.form.placeholders.webcontent_keypoints_points_content')}}">{{ $point['content'] }}</textarea>
                        </div>
                    @endforeach
                @endif
            </div>

            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.keypoints.points"></span>
        </div>

        <p class="text-lg text-primary font-bold">{{__('messages.dashboard.web.service.form.fields.webcontent_faqs')}}</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[faqs][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_title") }}</label>
            <input id="webcontent[faqs][title]" type="text" name="webcontent[faqs][title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_faqs_title") }}" value="{{ old("webcontent.faqs.title", $service->webcontent['faqs']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.faqs.title"></span>
        </div>

        <div class="my-4">
            <div class="w-full h-auto flex flex-row justify-between">
                <p class="text-sm text-primary font-bold">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_questions") }}</p>
                <button type="button" class="hover:bg-white hover:text-primary active:scale-95 duration-300 border-2 border-primary bg-primary text-white px-4 py-2 rounded-xl ml-auto disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-100" onclick="addQuestion('webcontent[faqs]')" {{ $formRequest === 'view' ? 'disabled' :'' }}>{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_questions_add") }}</button>
            </div>
            <!-- Container for dynamic points -->
            <div id="questions-container" class="mb-4 mt-4">

                @if($service)
                    <!-- Iterate over the existing questions -->
                    @foreach($service->webcontent['faqs']['questions'] as $index => $question)
                        <div class="question-item mb-4 mt-4 border-2 border-secondary-dark flex flex-col rounded-md p-4 animation-element in-view slide-in-up">
                            <div class="flex flex-row justify-between w-full h-auto">
                                <p class="text-sm font-bold text-primary capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_question") }} {{ $index + 1 }}</p>

                                @if($formRequest !== 'view')
                                <button type="button" class="text-sm font-bold text-primary capitalize rounded-xl active:scale-95 duration-300 transition-all bg-secondary-dark hover:bg-primary px-4 py-2 text-white" onclick="this.closest('.question-item').remove(); updateQuestionTitles('webcontent[faqs][questions]')">
                                    {{ __('messages.common.delete') }}
                                </button>
                                @endif
                            </div>

                            <label class="block text-sm font-bold text-secondary-dark capitalize mt-2">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_question_question") }}</label>
                            <input type="text" name="webcontent[faqs][questions][{{ $index }}][question]" value="{{ $question['question'] }}" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_faqs_question") }}">

                            <label class="block text-sm font-bold text-secondary-dark capitalize mt-2">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_question_answer") }}</label>
                            <textarea name="webcontent[faqs][questions][{{ $index }}][answer]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_faqs_answer") }}">{{ $question['answer'] }}</textarea>
                        </div>
                    @endforeach
                @endif
            </div>

            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.faqs.questions"></span>
        </div>




        <!-- Submit Button -->
        <div class="flex {{ $formRequest == "view" ? 'justify-end' : 'justify-between' }} ">
            <button type="button" onclick="clearContent()" class="clear_content_form_button px-4 py-2 bg-secondary-dark text-white duration-300 hover:bg-primary rounded-md active:scale-95 capitalize">
                <p>
                    {{ __('messages.dashboard.web.service.form.buttons.cancel') }}
                </p>
            </button>
            @if($formRequest != 'view')
                <button  type="submit"  class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ $formRequest == "update" ? __('messages.dashboard.web.service.form.buttons.update') : __('messages.dashboard.web.service.form.buttons.create') }}
                </button>
            @endif
        </div>
    </form>
</div>
