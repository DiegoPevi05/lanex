<div class="w-full h-full pe-2">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.transport_type.form.headers.update") : __("messages.dashboard.transport_type.form.headers.create")) : __("messages.dashboard.transport_type.form.headers.view")  }}</h5>

    <form id="transport_type-form"
      action="{{ $formRequest === 'create' ? route('transport_type.store') : ($formRequest === 'update' ? route('transport_type.update', $transport_type->id) : '#') }}"
      enctype="multipart/form-data"
      method="POST">
        @csrf <!-- Include CSRF token for security -->

        @if($formRequest === 'update')
            @method('PUT') <!-- Specify PUT method for updating -->
        @endif
        <!-- Type Field -->
        <div class="mb-4 mt-4">
            <label for="type" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.transport_type.form.fields.type") }}</label>
            <input type="text" id="type" name="type" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('type', $transport_type->type ?? '') }}" placeholder="{{ __("messages.dashboard.transport_type.form.placeholders.type") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-type"></span>
        </div>

        <!-- Icon Field -->
        <div class="mb-4 mt-4">
            <label for="icon" class="block text-sm font-bold text-secondary-dark capitalize">
                {{ __("messages.dashboard.transport_type.form.fields.icon") }}
            </label>

            <select id="icon" name="icon" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" {{ $formRequest === "view" ? "disabled" : "" }}>
                <option value="" selected>{{ __("messages.dashboard.transport_type.form.placeholders.icon") }}</option>

                @foreach($icons as $filename => $content)
                    <option value="{{ $content }}" {{ old('icon', $transport_type->icon ?? '') === $content ? 'selected' : '' }}>
                        {{ $filename }}
                    </option>
                @endforeach
            </select>

            <span class="text-primary font-bold text-xs error-message" id="error-icon"></span>
        </div>
        <!-- Name Field -->
        <div class="mb-4 mt-4">
            <label for="name" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.transport_type.form.fields.name") }}</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('name', $transport_type->name ?? '') }}" placeholder="{{ __("messages.dashboard.transport_type.form.placeholders.name") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-name"></span>
        </div>


        <!-- Description Text Field -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.transport_type.form.fields.description') }}</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.transport_type.form.placeholders.description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old('description', $transport_type->description ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-description"></span>
        </div>

        <!-- Status Field -->
        <div class="mb-4 mt-4">
            <label for="status" class="block text-sm font-bold text-secondary-dark capitalize">
                {{ __("messages.dashboard.transport_type.form.fields.status") }}
            </label>

            <select id="status" name="status" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" {{ $formRequest === "view" ? "disabled" : "" }}>
                <option value="" disabled selected>{{ __("messages.dashboard.transport_type.form.placeholders.status") }}</option>

                <option value="ACTIVE" {{ old('status', $transport_type->status ?? '') === "ACTIVE" ? 'selected' : '' }}>
                {{__('messages.common.ACTIVE')}}
                </option>

                <option value="INACTIVE" {{ old('status', $transport_type->status ?? '') === "INACTIVE" ? 'selected' : '' }}>
                {{__('messages.common.INACTIVE')}}
                </option>
            </select>

            <span class="text-primary font-bold text-xs error-message" id="error-status"></span>
        </div>

        <!-- Submit Button -->
        <div class="flex {{ $formRequest == "view" ? 'justify-end' : 'justify-between' }} ">
            <button type="button" onclick="clearContent()" class="clear_content_form_button px-4 py-2 bg-secondary-dark text-white duration-300 hover:bg-primary rounded-md active:scale-95 capitalize">
                <p>
                    {{ __('messages.dashboard.transport_type.form.buttons.cancel') }}
                </p>
            </button>
            @if($formRequest != 'view')
                <button  type="submit"  class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ $formRequest == "update" ? __('messages.dashboard.transport_type.form.buttons.update') : __('messages.dashboard.transport_type.form.buttons.create') }}
                </button>
            @endif
        </div>
    </form>
</div>

