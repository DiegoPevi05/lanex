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

        <!-- Slug Field -->
        <div class="mb-4">
            <label for="slug" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.blog.form.fields.slug") }}</label>
            <input type="text" id="slug" name="slug" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" 
                value="{{ old('slug', $blog->slug ?? '') }}" 
                placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.slug') }}" 
                {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-slug"></span>
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
            <div class="flex flex-row justify-start gap-x-2">
                <input type="text" id="previewContent" name="previewContent" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" 
                    value="{{ old('previewContent', $blog->previewContent ?? '') }}" 
                placeholder="{{ __('messages.dashboard.web.blog.form.placeholders.preview_content') }}" 
                {{$formRequest === "view" ? "disabled" : ""}}>
                <button type="button" class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ __('messages.dashboard.web.blog.form.buttons.preview') }}
                </button>
            </div>
            <div class="mt-4">
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