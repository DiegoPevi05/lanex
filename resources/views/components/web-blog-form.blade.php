<div class="w-full h-full pe-2">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.web.blog.form.headers.update") : __("messages.dashboard.web.blog.form.headers.create")) : __("messages.dashboard.web.blog.form.headers.view") }}</h5>

    <form id="blog-form"
      action="{{ $formRequest === 'create' ? route('blogs.store') : ($formRequest === 'update' ? route('blogs.update', $blog->id) : '#') }}"
      enctype="multipart/form-data"
      method="POST">
        @csrf
        @if($formRequest === 'update')
            @method('PUT')
        @endif

        <!-- Title Field -->
        <div class="mb-4 mt-4">
            <label for="title" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.blog.form.fields.title") }}</label>
            <input type="text" id="title" name="title" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"
                value="{{ old('title', $blog->title ?? '') }}"
                placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.title') }}"
                {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-title"></span>
        </div>

        <!-- Featured Image -->
        <div class="mb-4 mt-4">
            <label for="featured_image" class="block text-sm font-bold text-secondary-dark capitalize mb-4">{{ __("messages.dashboard.web.blog.form.fields.featured_image") }}</label>
            <div class="flex flex-row justify-start gap-x-2">
                <div id="image-viewer-featured_image" class="h-[150px] w-[150px] border-2 border-gray-light rounded-xl bg-contain bg-no-repeat bg-center"
                    style="background-image:url({{ $blog ? asset('storage/' . $blog->featured_image) : '' }})">
                </div>
                <div class="file-select" id="src-tent-featured_image">
                    <input type="file" name="featured_image" aria-label="featured_image" onchange="previewImage(event, 'featured_image')" {{$formRequest === "view" ? "disabled" : ""}}/>
                </div>
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-featured_image"></span>
        </div>

        <!-- Thumbnail Image -->
        <div class="mb-4 mt-4">
            <label for="thumbnail_image" class="block text-sm font-bold text-secondary-dark capitalize mb-4">{{ __("messages.dashboard.web.blog.form.fields.thumbnail_image") }}</label>
            <div class="flex flex-row justify-start gap-x-2">
                <div id="image-viewer-thumbnail_image" class="h-[150px] w-[150px] border-2 border-gray-light rounded-xl bg-contain bg-no-repeat bg-center"
                    style="background-image:url({{ $blog ? asset('storage/' . $blog->thumbnail_image) : '' }})">
                </div>
                <div class="file-select" id="src-tent-thumbnail_image">
                    <input type="file" name="thumbnail_image" aria-label="thumbnail_image" onchange="previewImage(event, 'thumbnail_image')" {{$formRequest === "view" ? "disabled" : ""}}/>
                </div>
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-thumbnail_image"></span>
        </div>

        <!-- Excerpt Field -->
        <div class="mb-4">
            <label for="excerpt" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.fields.excerpt') }}</label>
            <textarea id="excerpt" name="excerpt" rows="2" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"
                placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.excerpt') }}"
                {{$formRequest === "view" ? "disabled" : ""}}>{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-excerpt"></span>
        </div>

        <!-- Content Field -->
        <div class="mb-4">
            <label for="content" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.fields.content') }}</label>
            <div class="w-full flex flex-col justify-start gap-x-2">
                <button id="add-blog-content-button" type="button" class="ml-auto w-fit px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ __('messages.dashboard.web.blog.form.placeholders.add_content') }}
                </button>
                <input type="text" id="previewContentHeader" name="previewContentHeader" class="ml-auto mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"
                    placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.content_preview_header') }}"
                    {{$formRequest === "view" ? "disabled" : ""}}>
                <textarea id="previewContentBody" name="previewContentBody" rows="10" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"
                    placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.content_preview_content') }}"
                    {{$formRequest === "view" ? "disabled" : ""}}></textarea>
            </div>
            <label for="listContent" class="mt-4 block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.placeholders.list_content') }}</label>
            <div id="blog-content-container" class="my-4 flex flex-col justify-start gap-y-2">
                @if($blog && isset($blog->content) && is_array($blog->content) && count($blog->content) > 0)
                    @foreach($blog->content as $index => $content)
                        <div id="blog-content-item-{{$index}}" class="blog-content-item relative w-full flex flex-col justify-start gap-x-2 border-2 border-gray-light rounded-xl p-4">
                            <button id="blog-content-item-delete-button-{{$index}}"
                                    onclick="deleteBlogContent({{$index}})"
                                    class="w-8 h-8 top-1 right-1 absolute p-1 bg-primary text-white duration-300 hover:bg-primary-dark rounded-full active:scale-95 capitalize">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x text">
                                    <path d="M18 6 6 18"/>
                                    <path d="m6 6 12 12"/>
                                </svg>
                            </button>
                            @if($content['header'])
                            <label class="block text-sm font-bold text-secondary-dark capitalize">
                                {{ $content['header'] }}
                                </label>
                            @endif
                            @if($content['content'])
                                <label class="block text-sm font-bold text-secondary-dark capitalize">
                                    {{ \Illuminate\Support\Str::limit($content['content'], 100, '...') }}
                                </label>
                            @endif

                            <input type="hidden" name="content[{{$index}}][header]" value="{{ $content['header'] }}">
                            <input type="hidden" name="content[{{$index}}][content]" value="{{ $content['content'] }}">
                        </div>
                    @endforeach
                @endif
            </div>
             <span class="text-primary font-bold text-xs error-message" id="error-content"></span>
        </div>

        <!-- Author Field -->
        <div class="mb-4">
            <label for="author" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.fields.author') }}</label>
            <input type="text" id="author" name="author" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"
                value="{{ old('author', $blog->author ?? '') }}"
                placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.author') }}"
                {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-author"></span>
        </div>

        <!-- Category Field -->
        <div class="mb-4">
            <label for="category" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.fields.category') }}</label>
            <input type="text" id="category" name="category" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"
                value="{{ old('category', $blog->category ?? '') }}"
                placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.category') }}"
                {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-category"></span>
        </div>

        <!-- Status Field -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.fields.status') }}</label>
            <select id="status" name="status" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" {{$formRequest === "view" ? "disabled" : ""}}>
                <option value="draft" {{ (old('status', $blog->status ?? '') == 'draft') ? 'selected' : '' }}>{{ __('messages.dashboard.web.blog.form.status.draft') }}</option>
                <option value="published" {{ (old('status', $blog->status ?? '') == 'published') ? 'selected' : '' }}>{{ __('messages.dashboard.web.blog.form.status.published') }}</option>
                <option value="archived" {{ (old('status', $blog->status ?? '') == 'archived') ? 'selected' : '' }}>{{ __('messages.dashboard.web.blog.form.status.archived') }}</option>
            </select>
            <span class="text-primary font-bold text-xs error-message" id="error-status"></span>
        </div>

        <!-- Reading Time Field -->
        <div class="mb-4">
            <label for="reading_time" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.fields.reading_time') }}</label>
            <input type="number" id="reading_time" name="reading_time" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"
                value="{{ old('reading_time', $blog->reading_time ?? '') }}"
                placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.reading_time') }}"
                min="1"
                {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-reading_time"></span>
        </div>

        <!-- Header Type Field -->
        <div class="mb-4">
            <label for="header_type" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.fields.header_type') }}</label>
            <select id="header_type" name="header_type" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" {{$formRequest === "view" ? "disabled" : ""}}>
                <option value="normal" {{ (old('header_type', $blog->header_type ?? '') == 'normal') ? 'selected' : '' }}>{{ __('messages.dashboard.web.blog.form.header_type.normal') }}</option>
                <option value="video" {{ (old('header_type', $blog->header_type ?? '') == 'video') ? 'selected' : '' }}>{{ __('messages.dashboard.web.blog.form.header_type.video') }}</option>
                <option value="slideshow" {{ (old('header_type', $blog->header_type ?? '') == 'slideshow') ? 'selected' : '' }}>{{ __('messages.dashboard.web.blog.form.header_type.slideshow') }}</option>
            </select>
            <span class="text-primary font-bold text-xs error-message" id="error-header_type"></span>
        </div>

        <!-- Sub Header Field -->
        <div class="mb-4">
            <label for="sub_header" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.fields.sub_header') }}</label>
            <input type="text" id="sub_header" name="sub_header" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"
                value="{{ old('sub_header', $blog->sub_header ?? '') }}"
                placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.sub_header') }}"
                {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-sub_header"></span>
        </div>


        <div class="mb-4">
            <label for="tags" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.fields.tags') }}</label>
            <div class="w-full flex flex-row justify-start gap-x-2">

                <input type="text" id="previewTag" name="previewTag" class="ml-auto mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"
                    placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.tag_preview') }}"
                    {{$formRequest === "view" ? "disabled" : ""}}>

                <button id="add-tag-button" type="button" class="w-fit px-4 py-2 bg-primary text-white text-nowrap duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ __('messages.dashboard.web.blog.form.placeholders.add_tag') }}
                </button>
            </div>
            <label for="listContent" class="mt-4 block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.blog.form.placeholders.tags') }}</label>
            <div id="tags-container" class="mt-4 flex flex-row flex-wrap gap-x-2 justify-start gap-y-2">
                    @if($blog && isset($blog->tags) && is_array($blog->tags) && count($blog->tags) > 0)
                        @foreach($blog->tags as $index => $tag)
                            <span id="tag-item-{{$index}}" class="tag-item flex flex-row w-fit h-auto items-center px-3 py-1 bg-primary text-white rounded-full gap-x-2">
                                {{ $tag }}
                                <button id="tag-item-delete-button-{{$index}}"
                                        onclick="deleteTag({{$index}})"
                                        class="w-6 h-6 p-1 bg-primary text-white duration-300 hover:bg-primary-dark rounded-full active:scale-95 capitalize">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x text-inherit">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                                </button>
                                <input type="hidden" name="tags[{{$index}}]" value="{{ $tag }}">
                            </span>
                        @endforeach
                    @endif
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-tags"></span>
        </div>

        <!-- Submit Buttons -->
        <div class="flex {{ $formRequest == "view" ? 'justify-end' : 'justify-between' }} ">
            <button type="button" onclick="clearContent()" class="clear_content_form_button px-4 py-2 bg-secondary-dark text-white duration-300 hover:bg-primary rounded-md active:scale-95 capitalize">
                <p>{{ __('messages.dashboard.web.blog.form.buttons.cancel') }}</p>
            </button>
            @if($formRequest != 'view')
                <button type="submit" class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ $formRequest == "update" ? __('messages.dashboard.web.blog.form.buttons.update') : __('messages.dashboard.web.blog.form.buttons.create') }}
                </button>
            @endif
        </div>
    </form>
</div>
