<div class="w-full h-full pe-2">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.web.product.form.headers.update") : __("messages.dashboard.web.product.form.headers.create")) : __("messages.dashboard.web.product.form.headers.view")  }}</h5>

    <form id="product-form"
      action="{{ $formRequest === 'create' ? route('products.store') : ($formRequest === 'update' ? route('products.update', $product->id) : '#') }}"
      enctype="multipart/form-data"
      method="POST">
        @csrf <!-- Include CSRF token for security -->

        @if($formRequest === 'update')
            @method('PUT') <!-- Specify PUT method for updating -->
        @endif
        <!-- Name Field -->
        <div class="mb-4 mt-4">
            <label for="name" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.product.form.fields.name") }}</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('name', $product->name ?? '') }}" placeholder="{{ __("messages.dashboard.web.product.form.placeholders.name") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-name"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="image" class="block text-sm font-bold text-secondary-dark capitalize mb-4">{{ __("messages.dashboard.web.product.form.fields.image") }}</label>
            <div class="flex flex-row justify-start gap-x-2">
                <div id="image-viewer-image" class="h-[150px] w-[150px] border-2 border-gray-light rounded-xl bg-contain bg-no-repeat bg-center" style="background-image:url({{ $product ? asset('storage/' . $product->image) : '' }})">

                </div>
                <div class="file-select" id="src-tent-image" >
                  <input type="file" name="image" aria-label="image" onchange="previewImage(event, 'image')" {{$formRequest === "view" ? "disabled" : ""}}/>
                </div>
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-image"></span>
        </div>


        <!-- Description Text Field -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.product.form.fields.description') }}</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.product.form.placeholders.description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old('description', $product->description ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-description"></span>
        </div>

        <!-- Stars Field -->
        <div class="mb-4">
            <label for="stars" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.product.form.fields.stars') }}</label>
            <input type="number" id="stars" name="stars" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" min="1" max="5" value="{{ old('stars', $product->stars ?? '') }}"  placeholder="{{ __("messages.dashboard.web.product.form.placeholders.stars") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-stars"></span>
        </div>

        <!-- Suppliers -->
        <div class="mb-4 mt-4">
            <div class="w-full h-auto flex flex-col justify-start">
                <p class="text-sm text-primary font-bold capitalize">{{ __("messages.dashboard.web.product.form.fields.suppliers") }}</p>
                <div class="w-full h-auto flex flex-row gap-x-4">
                    <select name="suppliers_options" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body">
                        <option>{{ __("messages.common.no_suppliers_options") }}</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                    </select>
                    <button type="button" class="hover:bg-white hover:text-primary active:scale-95 duration-300 border-2 border-primary bg-primary text-white px-4 py-2 rounded-xl ml-auto disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-100 w-[30%]" onclick="addEntity('supplier','{{__('messages.dashboard.web.supplier.name')}}')" {{ $formRequest === 'view' ? 'disabled' :'' }}>{{ __("messages.dashboard.web.product.form.fields.add_supplier") }}</button>
                </div>
            </div>
            <!-- Container for dynamic points -->
            <div id="suppliers-container" class="mb-4 mt-4">
                @if($product && $product->suppliers)
                    @foreach($product->suppliers as $index => $supplier)
                        <div class="supplier-item mb-4 mt-4 border-2 border-secondary-dark flex flex-col rounded-md p-4 animation-element in-view slide-in-up">
                            <div class="flex flex-row justify-between w-full h-auto">
                                <p class="text-sm font-bold text-primary capitalize">{{ __("messages.dashboard.web.product.form.fields.supplier") }} {{ $supplier->id }}</p>

                                @if($formRequest !== 'view')
                                <button type="button" class="text-sm font-bold text-primary capitalize rounded-xl active:scale-95 duration-300 transition-all bg-secondary-dark hover:bg-primary px-4 py-2 text-white" onclick="this.closest('.supplier-item').remove(); updateEntityIndex('supplier');">
                                    {{ __('messages.common.delete') }}
                                </button>
                                @endif
                            </div>
                            <input type="text" value="{{ $supplier->name }}" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.product.form.placeholders.suppliers") }}" disabled>
                            <input type="hidden" name="suppliers[{{ $index }}]" value="{{$supplier->id}}">
                        </div>
                    @endforeach
                @endif
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-suppliers"></span>
        </div>

        <!-- Submit Button -->
        <div class="flex {{ $formRequest == "view" ? 'justify-end' : 'justify-between' }} ">
            <button type="button" onclick="clearContent()" class="clear_content_form_button px-4 py-2 bg-secondary-dark text-white duration-300 hover:bg-primary rounded-md active:scale-95 capitalize">
                <p>
                    {{ __('messages.dashboard.web.product.form.buttons.cancel') }}
                </p>
            </button>
            @if($formRequest != 'view')
                <button  type="submit"  class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ $formRequest == "update" ? __('messages.dashboard.web.product.form.buttons.update') : __('messages.dashboard.web.product.form.buttons.create') }}
                </button>
            @endif
        </div>
    </form>
</div>

