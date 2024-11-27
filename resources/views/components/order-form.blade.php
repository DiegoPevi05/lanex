<div class="w-full h-full pe-2">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.order.form.headers.update") : __("messages.dashboard.order.form.headers.create")) : __("messages.dashboard.order.form.headers.view")  }}</h5>

    <form id="order-form"
      action="{{ $formRequest === 'create' ? route('order.store') : ($formRequest === 'update' ? route('order.update', $order->id) : '#') }}"
      enctype="multipart/form-data"
      method="POST">
        @csrf <!-- Include CSRF token for security -->

        @if($formRequest === 'update')
            @method('PUT') <!-- Specify PUT method for updating -->
        @endif

        <!-- Order Number Field -->
        @if($order && $order->order_number)
            <div class="mb-4 mt-4">
                <label for="order_number" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.order_number") }}</label>
                <input type="text" id="order_number" name="order_number" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('order_number', $order->order_number ?? '') }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.order_number") }}" disabled>
                <span class="text-primary font-bold text-xs error-message" id="error-order_number"></span>
            </div>
        @endif

        <!-- Order Details -->
        <div class="mb-4 mt-4">
            <label for="details" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.details") }}</label>
            <textarea type="text" id="details" name="details" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.order.form.placeholders.details") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old('details', $order->details ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-details"></span>
        </div>

        <!-- Order Net Amount Field -->
        <div class="mb-4 mt-4">
            <label for="net_amount" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.net_amount") }}</label>
            <input type="number" step="0.01" id="net_amount" name="net_amount" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('net_amount', $order->net_amount ?? '') }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.net_amount") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-net_amount"></span>
        </div>

        <!-- Order Taxes Field  -->
        <div class="mb-4 mt-4">
            <label for="taxes" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.taxes") }}</label>
            <input type="number" step="0.01" id="taxes" name="taxes" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('taxes', $order->taxes ?? '') }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.taxes") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-taxes"></span>
        </div>

        <!-- Order Operative Cost Field  -->
        <div class="mb-4 mt-4">
            <label for="operative_cost" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.operative_cost") }}</label>
            <input type="text" id="operative_cost" name="operative_cost" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('operative_cost', $order->operative_cost ?? '') }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.operative_cost") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-operative_cost"></span>
        </div>

        <!--  Numero Dam Field  -->
        <div class="mb-4 mt-4">
            <label for="numero_dam" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.numero_dam") }}</label>
            <input type="text" id="numero_dam" name="numero_dam" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('numero_dam', $order->numero_dam ?? '') }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.numero_dam") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-numero_dam"></span>
        </div>

        <!--  Manifest Field  -->
        <div class="mb-4 mt-4">
            <label for="manifest" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.manifest") }}</label>
            <input type="text" id="manifest" name="manifest" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('manifest', $order->manifest ?? '') }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.manifest") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-manifest"></span>
        </div>

        <!--  channel Field  -->
        <div class="mb-4 mt-4">
            <label for="channel" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.channel") }}</label>
            <input type="text" id="channel" name="channel" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('channel', $order->channel ?? '') }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.channel") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-channel"></span>
        </div>

        <!-- Freights In the order -->
        <div class="mb-4 mt-4">
            <label for="freights" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.name').'s' }}</label>

            @foreach ($order->freights as $freight)
                <!-- Freight Card -->
                <div class="w-full h-auto grid grid-cols-2 text-body gap-y-2 border-2 border-gray-light rounded-xl p-4">
                    <div class="col-span-2 flex flex-col justify-start items-start">
                        <div class="inline-flex gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M22 7.7c0-.6-.4-1.2-.8-1.5l-6.3-3.9a1.72 1.72 0 0 0-1.7 0l-10.3 6c-.5.2-.9.8-.9 1.4v6.6c0 .5.4 1.2.8 1.5l6.3 3.9a1.72 1.72 0 0 0 1.7 0l10.3-6c.5-.3.9-1 .9-1.5Z"/><path d="M10 21.9V14L2.1 9.1"/><path d="m10 14 11.9-6.9"/><path d="M14 19.8v-8.1"/><path d="M18 17.5V9.4"/></svg>
                            <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.name') .' '. $freight->id }} :</p>
                        </div>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.name') }}:</p>
                        <input type="text" id="freight[0]['name']" name="freight[0]['name']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['name']", $freight->name ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.name") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.description') }}:</p>
                        <input type="text" id="freight[0]['description']" name="freight[0]['description']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['description']", $freight->description ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.description") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions_units') }}:</p>
                        <input type="text" id="freight[0]['dimensions_units']" name="freight[0]['dimensions_units']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['dimensions_units']", $freight->dimensions_units ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.dimensions_units") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions') }}:</p>
                        <input type="text" id="freight[0]['dimensions']" name="freight[0]['dimensions']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['dimensions']", $freight->dimensions ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.dimensions") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight_units') }}:</p>
                        <input type="text" id="freight[0]['weigth_units']" name="freight[0]['weigth_units']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['weigth_units']", $freight->weigth_units ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.weigth_units") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight') }}:</p>
                        <input type="text" id="freight[0]['weigth']" name="freight[0]['weigth']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['weigth']", $freight->weigth ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.weigth") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume_units') }}:</p>
                        <input type="text" id="freight[0]['volume_units']" name="freight[0]['volume_units']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['volume_units']", $freight->volume_units ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.volume_units") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume') }}:</p>
                        <input type="text" id="freight[0]['volume']" name="freight[0]['volume']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['volume']", $freight->volume ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.volume") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.packages') }}:</p>
                        <input type="text" id="freight[0]['packages']" name="freight[0]['packages']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['packages']", $freight->packages ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.volume") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                    <div class="col-span-1 flex flex-col justify-start items-start">
                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.incoterms') }}:</p>
                        <input type="text" id="freight[0]['incoterms']" name="freight[0]['incoterms']" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("freight[0]['incoterms']", $freight->incoterms ?? '') }}" placeholder="{{ __("messages.dashboard.freight.form.fields.incoterms") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    </div>
                </div>
            @endforeach

        </div>


        <!-- Submit Button -->
        <div class="flex {{ $formRequest == "view" ? 'justify-end' : 'justify-between' }} ">
            <button type="button" onclick="clearContent()" class="clear_content_form_button px-4 py-2 bg-secondary-dark text-white duration-300 hover:bg-primary rounded-md active:scale-95 capitalize">
                <p>
                    {{ __('messages.dashboard.order.form.buttons.cancel') }}
                </p>
            </button>
            @if($formRequest != 'view')
                <button  type="submit"  class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ $formRequest == "update" ? __('messages.dashboard.order.form.buttons.update') : __('messages.dashboard.order.form.buttons.create') }}
                </button>
            @endif
        </div>
    </form>
</div>

