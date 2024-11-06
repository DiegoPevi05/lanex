<div class="w-full h-full pe-2">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.client.form.headers.update") : __("messages.dashboard.client.form.headers.create")) : __("messages.dashboard.client.form.headers.view")  }}</h5>

    <form id="client-form"
      action="{{ $formRequest === 'create' ? route('client.store') : ($formRequest === 'update' ? route('client.update', $client->id) : '#') }}"
      enctype="multipart/form-data"
      method="POST">
        @csrf <!-- Include CSRF token for security -->

        @if($formRequest === 'update')
            @method('PUT') <!-- Specify PUT method for updating -->
        @endif

        <!-- Client Id Field -->
        @if($client->client_id)
            <div class="mb-4 mt-4">
                <label for="client_id" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.client.form.fields.client_id") }}</label>
                <input type="text" id="client_id" name="client_id" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('client_id', $client->client_id ?? '') }}" placeholder="{{ __("messages.dashboard.client.form.placeholders.client_id") }}" disabled>
                <span class="text-primary font-bold text-xs error-message" id="error-client_id"></span>
            </div>
        @endif

        <!-- Company Field -->
        <div class="mb-4 mt-4">
            <label for="company" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.client.form.fields.company") }}</label>
            <input type="text" id="company" name="company" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('company', $client->company ?? '') }}" placeholder="{{ __("messages.dashboard.client.form.placeholders.company") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-company"></span>
        </div>

        <!-- RUC Field -->
        <div class="mb-4 mt-4">
            <label for="RUC" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.client.form.fields.RUC") }}</label>
            <input type="text" id="RUC" name="RUC" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('RUC', $client->RUC ?? '') }}" placeholder="{{ __("messages.dashboard.client.form.placeholders.RUC") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-RUC"></span>
        </div>

        <!-- Cellphone Field -->
        <div class="mb-4 mt-4">
            <label for="cellphone" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.client.form.fields.cellphone") }}</label>
            <input type="text" id="cellphone" name="cellphone" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('cellphone', $client->cellphone ?? '') }}" placeholder="{{ __("messages.dashboard.client.form.placeholders.cellphone") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-cellphone"></span>
        </div>

        <!-- Email Field -->
        <div class="mb-4 mt-4">
            <label for="email" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.client.form.fields.email") }}</label>
            <input type="text" id="email" name="email" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('email', $client->email ?? '') }}" placeholder="{{ __("messages.dashboard.client.form.placeholders.email") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-email"></span>
        </div>

        <!-- Submit Button -->
        <div class="flex {{ $formRequest == "view" ? 'justify-end' : 'justify-between' }} ">
            <button type="button" onclick="clearContent()" class="clear_content_form_button px-4 py-2 bg-secondary-dark text-white duration-300 hover:bg-primary rounded-md active:scale-95 capitalize">
                <p>
                    {{ __('messages.dashboard.client.form.buttons.cancel') }}
                </p>
            </button>
            @if($formRequest != 'view')
                <button  type="submit"  class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ $formRequest == "update" ? __('messages.dashboard.client.form.buttons.update') : __('messages.dashboard.client.form.buttons.create') }}
                </button>
            @endif
        </div>
    </form>
</div>

