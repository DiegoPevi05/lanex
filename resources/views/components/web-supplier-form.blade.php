<div class="w-full h-full pe-2">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.web.supplier.form.headers.update") : __("messages.dashboard.web.supplier.form.headers.create")) : __("messages.dashboard.web.supplier.form.headers.view")  }}</h5>

    <form id="supplier-form"
      action="{{ $formRequest === 'create' ? route('suppliers.store') : ($formRequest === 'update' ? route('suppliers.update', $supplier->id) : '#') }}"
      enctype="multipart/form-data"
      method="POST">
        @csrf <!-- Include CSRF token for security -->

        @if($formRequest === 'update')
            @method('PUT') <!-- Specify PUT method for updating -->
        @endif
        <!-- Name Field -->
        <div class="mb-4 mt-4">
            <label for="name" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.supplier.form.fields.name") }}</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('name', $supplier->name ?? '') }}" placeholder="{{ __("messages.dashboard.web.supplier.form.placeholders.name") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-name"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="logo" class="block text-sm font-bold text-secondary-dark capitalize mb-4">{{ __("messages.dashboard.web.supplier.form.fields.logo") }}</label>
            <div class="flex flex-row justify-start gap-x-2">
                <div id="image-viewer-logo" class="h-[150px] w-[150px] border-2 border-gray-light rounded-xl bg-contain bg-no-repeat bg-center" style="background-image:url({{ $supplier ? asset('storage/' . $supplier->logo) : '' }})">

                </div>
                <div class="file-select" id="src-tent-image" >
                  <input type="file" name="logo" aria-label="logo" onchange="previewImage(event, 'logo')" {{$formRequest === "view" ? "disabled" : ""}}/>
                </div>
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-logo"></span>
        </div>


        <!-- Description Text Field -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.supplier.form.fields.description') }}</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.supplier.form.placeholders.description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old('description', $supplier->description ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-description"></span>
        </div>

        <p class="text-lg text-primary font-bold mt-4 capitalize">{{ __("messages.dashboard.web.supplier.form.fields.details") }}</p>

        <div class="my-4">
            <div class="w-full h-auto flex flex-row justify-end">
                <button type="button" class="hover:bg-white hover:text-primary active:scale-95 duration-300 border-2 border-primary bg-primary text-white px-4 py-2 rounded-xl ml-auto disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-100"  onclick="addDetail()" {{$formRequest === 'view' ? 'disabled' : ''}}>{{__('messages.dashboard.web.supplier.form.fields.details_add')}}</button>
            </div>
            <!-- Container for dynamic details -->
            <div id="details-container" class="mb-4 mt-4">
                @if($supplier)
                    @foreach($supplier->details as $index => $detail)
                        <div class="detail-item mb-4 mt-4 border-2 border-secondary-dark flex flex-col rounded-md p-4 animation-element in-view slide-in-up">
                            <div class="flex flex-row justify-between w-full h-auto">
                                <p class="text-sm font-bold text-primary capitalize">{{__('messages.dashboard.web.supplier.form.fields.details_detail')}} {{ $index + 1 }}</p>
                                @if($formRequest !== 'view')
                                <button type="button" class="text-sm font-bold text-primary capitalize rounded-xl active:scale-95 duration-300 transition-all bg-secondary-dark hover:bg-primary px-4 py-2 text-white" onclick="this.closest('.detail-item').remove(); updateDetailTitles()">
                                    {{ __('messages.common.delete') }}
                                </button>
                                @endif
                            </div>

                            <label class="block text-sm font-bold text-secondary-dark capitalize mt-2">{{__('messages.dashboard.web.supplier.form.fields.details_detail')}}</label>
                            <textarea name="details[{{ $index }}]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body !h-[150px] no-scroll-bar" placeholder="{{__('messages.dashboard.web.supplier.form.placeholders.details_detail')}}">{{$detail}}</textarea>
                        </div>
                    @endforeach
                @endif
            </div>

            <span class="text-primary font-bold text-xs error-message" id="error-details"></span>
        </div>

        <!-- Products -->
        <div class="mb-4 mt-4">
            <div class="w-full h-auto flex flex-col justify-start">
                <p class="text-sm text-primary font-bold capitalize">{{ __("messages.dashboard.web.supplier.form.fields.products") }}</p>
                <div class="w-full h-auto flex flex-row gap-x-4">
                    <select name="products_options" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body">
                        <option>{{ __("messages.common.no_products_options") }}</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="hover:bg-white hover:text-primary active:scale-95 duration-300 border-2 border-primary bg-primary text-white px-4 py-2 rounded-xl ml-auto disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-100 w-[30%]" onclick="addEntity('product','{{__('messages.dashboard.web.product.name')}}')" {{ $formRequest === 'view' ? 'disabled' :'' }}>{{ __("messages.dashboard.web.supplier.form.fields.add_product") }}</button>
                </div>
            </div>
            <!-- Container for dynamic points -->
            <div id="products-container" class="mb-4 mt-4">
                @if($supplier->products)
                    @foreach($supplier->products as $index => $product)
                        <div class="product-item mb-4 mt-4 border-2 border-secondary-dark flex flex-col rounded-md p-4 animation-element in-view slide-in-up">
                            <div class="flex flex-row justify-between w-full h-auto">
                                <p class="text-sm font-bold text-primary capitalize">{{ __("messages.dashboard.web.product.name") }} {{ $product->id }}</p>

                                @if($formRequest !== 'view')
                                <button type="button" class="text-sm font-bold text-primary capitalize rounded-xl active:scale-95 duration-300 transition-all bg-secondary-dark hover:bg-primary px-4 py-2 text-white" onclick="this.closest('.product-item').remove(); updateEntityIndex('product');">
                                    {{ __('messages.common.delete') }}
                                </button>
                                @endif
                            </div>
                            <input type="text" value="{{ $product->name }}" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.supplier.form.placeholders.products") }}" disabled>
                            <input type="hidden" name="products[{{ $index }}]" value="{{$product->id}}">
                        </div>
                    @endforeach
                @endif
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-products"></span>
        </div>

        <!-- Services -->
        <div class="mb-4 mt-4">
            <div class="w-full h-auto flex flex-col justify-start">
                <p class="text-sm text-primary font-bold capitalize">{{ __("messages.dashboard.web.supplier.form.fields.services") }}</p>
                <div class="w-full h-auto flex flex-row gap-x-4">
                    <select name="services_options" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body">
                        <option>{{ __("messages.common.no_services_options") }}</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="hover:bg-white hover:text-primary active:scale-95 duration-300 border-2 border-primary bg-primary text-white px-4 py-2 rounded-xl ml-auto disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-100 w-[30%]" onclick="addEntity('service','{{__('messages.dashboard.web.service.name')}}')" {{ $formRequest === 'view' ? 'disabled' :'' }}>{{ __("messages.dashboard.web.supplier.form.fields.add_service") }}</button>
                </div>
            </div>
            <!-- Container for dynamic points -->
            <div id="services-container" class="mb-4 mt-4">
                @if($supplier->services)
                    @foreach($supplier->services as $index => $service)
                        <div class="service-item mb-4 mt-4 border-2 border-secondary-dark flex flex-col rounded-md p-4 animation-element in-view slide-in-up">
                            <div class="flex flex-row justify-between w-full h-auto">
                                <p class="text-sm font-bold text-primary capitalize">{{ __("messages.dashboard.web.service.name") }} {{ $service->id }}</p>

                                @if($formRequest !== 'view')
                                <button type="button" class="text-sm font-bold text-primary capitalize rounded-xl active:scale-95 duration-300 transition-all bg-secondary-dark hover:bg-primary px-4 py-2 text-white" onclick="this.closest('.service-item').remove(); updateEntityIndex('service');">
                                    {{ __('messages.common.delete') }}
                                </button>
                                @endif
                            </div>
                            <input type="text" value="{{ $service->name }}" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.supplier.form.placeholders.services") }}" disabled>
                            <input type="hidden" name="services[{{ $index }}]" value="{{$service->id}}">
                        </div>
                    @endforeach
                @endif
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-services"></span>
        </div>

        <!-- Submit Button -->
        <div class="flex {{ $formRequest == "view" ? 'justify-end' : 'justify-between' }} ">
            <button type="button" onclick="clearContent()" class="clear_content_form_button px-4 py-2 bg-secondary-dark text-white duration-300 hover:bg-primary rounded-md active:scale-95 capitalize">
                <p>
                    {{ __('messages.dashboard.web.supplier.form.buttons.cancel') }}
                </p>
            </button>
            @if($formRequest != 'view')
                <button  type="submit"  class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ $formRequest == "update" ? __('messages.dashboard.web.supplier.form.buttons.update') : __('messages.dashboard.web.supplier.form.buttons.create') }}
                </button>
            @endif
        </div>
    </form>
</div>

