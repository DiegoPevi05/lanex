<div class="w-full h-full">
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
            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('name', $service->name ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.name") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-name"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="icon" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.icon") }}</label>
            <input type="text" id="icon" name="icon" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('icon', $service->icon ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.icon") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-icon"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="short_description" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.short_description") }}</label>
            <textarea id="short_description" name="short_description" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.short_description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old('short_description', $service->short_description ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-short_description"></span>
        </div>

        <label class="text-lg text-primary font-bold">Web Content</label>

        <div class="mb-4 mt-4">
            <label for="webcontent[header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_header") }}</label>
            <input type="text" id="webcontent[header]" name="webcontent[header]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.header", $service->webcontent['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_header") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_title") }}</label>
            <input type="text" id="webcontent[title]" name="webcontent[title]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.title", $service->webcontent['title'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_title") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.title"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[description]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_description") }}</label>
            <textarea id="webcontent[description]" name="webcontent[description]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.description", $service->webcontent['description'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.description"></span>
        </div>


        <div class="mb-4 mt-4">
            <label for="webcontent[image]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_image") }}</label>
            <input type="file" id="webcontent[image]" name="webcontent[image]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.image", $service->webcontent['image'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_image") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.image"></span>
        </div>

        <p class="text-lg text-primary font-bold">Overview</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_header") }}</label>
            <input id="webcontent[overview][header]" type="text" name="webcontent[overview][header]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.overview.header", $service->webcontent['overview']['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_header") }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_title") }}</label>
            <input id="webcontent[overview][title]" type="text" name="webcontent[overview][title]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_title") }}" value="{{ old("webcontent.overview.title", $service->webcontent['overview']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.title"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][content][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_content_header") }}</label>
            <textarea id="webcontent[overview][content][header]" name="webcontent[overview][content][header]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_content_header") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.overview.content.header", $service->webcontent['overview']['content']['header'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][content][introduction]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_content_introduction") }}</label>
            <textarea id="webcontent[overview][content][introduction]" name="webcontent[overview][content][introduction]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_content_introduction") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.overview.content.introduction", $service->webcontent['overview']['content']['introduction'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content.introduction"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][content][content]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_content_content") }}</label>
            <textarea id="webcontent[overview][content][content]" name="webcontent[overview][content][content]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_content_content") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.overview.content.content", $service->webcontent['overview']['content']['content'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content.content"></span>
        </div>

        <p class="text-lg text-primary font-bold">Content Link</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_header") }}</label>
            <input id="webcontent[content_link][header]" type="text" name="webcontent[content_link][header]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.content_link.header", $service->webcontent['content_link']['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_header") }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_title") }}</label>
            <input id="webcontent[content_link][title]" type="text" name="webcontent[content_link][title]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_title") }}" value="{{ old("webcontent.content_link.title", $service->webcontent['content_link']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.title"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][button_label]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_button_label") }}</label>
            <input id="webcontent[content_link][button_label]" type="text" name="webcontent[content_link][button_label]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_button_label") }}" value="{{ old("webcontent.content_link.button_label", $service->webcontent['content_link']['button_label'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.button_label"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][image]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_image") }}</label>
            <input type="file" id="webcontent[content_link][image]" name="webcontent[content_link][image]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.content_link.image", $service->webcontent['content_link']['image'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_image") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.image"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][content]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_content") }}</label>
            <textarea id="webcontent[content_link][content]" name="webcontent[content_link][content]" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_content") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.content_link.content", $service->webcontent['content_link']['content'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.content"></span>
        </div>

        <p class="text-lg text-primary font-bold">Key Points</p>




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

