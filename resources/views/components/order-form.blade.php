<div class="w-full h-full pe-2">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.order.form.headers.update") : __("messages.dashboard.order.form.headers.create")) : __("messages.dashboard.order.form.headers.view")  }}</h5>

    <form id="order-form"
      action="{{ $formRequest === 'create' ? route('order.store') : ($formRequest === 'update' ? route('order.update', $order->id) : '#') }}"
      enctype="multipart/form-data"
      method="POST"
      >
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

        <div class="mb-4 mt-4 relative">
            <label for="client_name" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.client_id") }}</label>
            <input type="text" id="client_id" name="client_id" class="hidden" value="{{ old('client_id', $order->client_id ?? '')  }}">
            <input type="text" id="client_name" name="client_name" class="client_name_input mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('client_name', $order->client_name ?? '') }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.client_id") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <ul id="client_list" class="absolute left-0 top-[100%] bg-white w-full h-[100px] overflow-y-scroll border-2 border-gray-light hidden flex items-center justify-start flex-col py-2">
                <span id="client_list_loader" class="w-12 h-12 text-primary flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </span>
            </ul>
            <span class="text-primary font-bold text-xs error-message" id="error-client_id"></span>
        </div>

        <x-wrapper-scroll id="order_content" title="messages.dashboard.order.form.fields.content">

            <div class="w-full grid grid-cols-1 gap-4 justify-start items-start">
                <!-- Order Details -->
                <div class="col-span-1">
                    <label for="details" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.details") }}:</label>
                    <textarea type="text" id="details" name="details" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.order.form.placeholders.details") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old('details', $order->details ?? '') }}</textarea>
                    <span class="text-primary font-bold text-xs error-message" id="error-details"></span>
                </div>

                <!-- Order Net Amount Field -->
                <div class="col-span-1">
                    <label for="net_amount" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.net_amount") }}:</label>
                    <input type="number" step="0.01" id="net_amount" name="net_amount" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('net_amount', $order->net_amount ?? 0) }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.net_amount") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    <span class="text-primary font-bold text-xs error-message" id="error-net_amount"></span>
                </div>

                <!-- Order Taxes Field  -->
                <div class="col-span-1">
                    <label for="taxes" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.taxes") }} ({{ __('messages.common.optional') }}):</label>
                    <input type="number" step="0.01" id="taxes" name="taxes" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('taxes', $order->taxes ?? 0) }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.taxes") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    <span class="text-primary font-bold text-xs error-message" id="error-taxes"></span>
                </div>

                <!-- Order Operative Cost Field  -->
                <div class="col-span-1">
                    <label for="operative_cost" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.operative_cost") }} ({{ __('messages.common.optional') }}):</label>
                    <input type="number" id="operative_cost" name="operative_cost" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('operative_cost', $order->operative_cost ?? 0) }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.operative_cost") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    <span class="text-primary font-bold text-xs error-message" id="error-operative_cost"></span>
                </div>

                <!--  Numero Dam Field  -->
                <div class="col-span-1">
                    <label for="numero_dam" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.numero_dam") }} ({{ __('messages.common.optional') }}):</label>
                    <input type="number" id="numero_dam" name="numero_dam" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('numero_dam', $order->numero_dam ?? 0) }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.numero_dam") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    <span class="text-primary font-bold text-xs error-message" id="error-numero_dam"></span>
                </div>

                <!--  Manifest Field  -->
                <div class="col-span-1">
                    <label for="manifest" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.manifest") }} ({{ __('messages.common.optional') }}):</label>
                    <input type="number" id="manifest" name="manifest" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('manifest', $order->manifest ?? 0) }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.manifest") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    <span class="text-primary font-bold text-xs error-message" id="error-manifest"></span>
                </div>

                <!--  channel Field  -->
                <div class="col-span-1">
                    <label for="channel" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.order.form.fields.channel") }} ({{ __('messages.common.optional') }}):</label>
                    <input type="number" id="channel" name="channel" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('channel', $order->channel ?? 0) }}" placeholder="{{ __("messages.dashboard.order.form.placeholders.channel") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                    <span class="text-primary font-bold text-xs error-message" id="error-channel"></span>
                </div>
            </div>

        </x-wrapper-scroll>


        <x-wrapper-scroll id="freights" title="messages.dashboard.freight.plural">
            <!-- Freights In the order -->
            <div class="py-4">
                <div class="w-full h-auto flex flex-row justify-between py-4">
                    <label for="freights" class="block text-lg font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.name').'s' }}</label>
                    <button id="add_fregiht_btn" type="button" class="text-sm bg-primary hover:bg-primary-dark duration-300 p-2 rounded-lg transition-all text-white border-2 border-primary hover:border-primary-dark active:scale-95 capitalize">
                        {{__('messages.dashboard.freight.add_entity')}}
                    </button>
                </div>

                <div id="freights-items" class="w-full h-full flex flex-col justify-start items-start gap-y-4">

                    @if($order)
                        @foreach ($order->freights as $index => $freight)
                            <!-- Freight Card -->
                            <div class="freight-card w-full h-auto grid grid-cols-2 text-body gap-y-2 border-2 border-gray-light rounded-xl p-4 gap-4">
                                <div class="col-span-2 flex flex-row justify-between items-center">
                                    <div class="inline-flex gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M22 7.7c0-.6-.4-1.2-.8-1.5l-6.3-3.9a1.72 1.72 0 0 0-1.7 0l-10.3 6c-.5.2-.9.8-.9 1.4v6.6c0 .5.4 1.2.8 1.5l6.3 3.9a1.72 1.72 0 0 0 1.7 0l10.3-6c.5-.3.9-1 .9-1.5Z"/><path d="M10 21.9V14L2.1 9.1"/><path d="m10 14 11.9-6.9"/><path d="M14 19.8v-8.1"/><path d="M18 17.5V9.4"/></svg>
                                        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.name') .': '. $freight->freight_id }}</p>
                                    </div>
                                    <button id="delete_fregiht_btn_{{$index}}" type="button" onclick="this.closest('.freight-card').remove(); updateFreightIndices()" class="text-sm bg-primary hover:bg-primary-dark duration-300 p-2 rounded-lg transition-all text-white border-2 border-primary hover:border-primary-dark active:scale-95 capitalize">

                                        {{__('messages.dashboard.freight.delete_entity')}}
                                    </button>
                                </div>
                                <div class="col-span-2 hidden">
                                    <input type="text" id="freight[{{$index}}][id]" name="freight[{{$index}}][id]" class="hidden" value="{{ $freight->id ?? '' }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                </div>

                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.name') }}:</p>
                                    <input type="text" id="freight[{{$index}}][name]" name="freight[{{$index}}][name]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ $freight->name ?? '' }}" placeholder="{{ __("messages.dashboard.freight.form.fields.name") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                </div>

                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.origin') }}:</p>
                                    <input type="text" id="freight[{{$index}}][origin]" name="freight[{{$index}}][origin]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ $freight->origin ?? '' }}" placeholder="{{ __("messages.dashboard.freight.form.fields.origin") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                </div>

                                <div class="col-span-2 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.description') }}:</p>
                                    <input type="text" id="freight[{{$index}}][description]" name="freight[{{$index}}][description]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ $freight->description ?? '' }}" placeholder="{{ __("messages.dashboard.freight.form.fields.description") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                </div>

                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions_units') }} ({{ __('messages.common.optional') }}):</p>
                                    <select id="freight[{{$index}}][dimensions_units]" name="freight[{{$index}}][dimensions_units]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{  $freight->dimensions_units ?? '' }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                        <option value="">{{ __("messages.dashboard.freight.form.fields.dimensions_units") }}</option>

                                        <option value="m">{{ __("messages.common.meters") }}</option>
                                        <option value="mm">{{ __("messages.common.milimeters") }}</option>
                                        <option value="cm">{{ __("messages.common.centimeters") }}</option>
                                        <option value="in">{{ __("messages.common.inches") }}</option>

                                    </select>
                                </div>
                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions') }} ({{ __('messages.common.optional') }}):</p>
                                    <input type="number" id="freight[{{$index}}][dimensions]" name="freight[{{$index}}][dimensions]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ $freight->dimensions ?? 0 }}" placeholder="{{ __("messages.dashboard.freight.form.fields.dimensions") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                </div>
                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight_units') }} ({{ __('messages.common.optional') }}):</p>
                                    <select id="freight[{{$index}}][weight_units]" name="freight[{{$index}}][weight_units]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ $freight->weight_units ?? '' }}"  {{$formRequest === "view" ? "disabled" : ""}}>
                                        <option value="">{{ __("messages.dashboard.freight.form.fields.weight_units") }}</option>
                                        <option value="kg">{{ __("messages.common.kilograms") }}</option>
                                        <option value="lbs">{{ __("messages.common.pounds") }}</option>
                                    </select>
                                </div>
                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight') }} ({{ __('messages.common.optional') }}):</p>
                                    <input type="number" id="freight[{{$index}}][weight]" name="freight[{{$index}}][weight]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ $freight->weight ?? 0 }}" placeholder="{{ __("messages.dashboard.freight.form.fields.weight") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                </div>
                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume_units') }} ({{ __('messages.common.optional') }}):</p>
                                    <select id="freight[{{$index}}][volume_units]" name="freight[{{$index}}][volume_units]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ $freight->volume_units ?? '' }}"  {{$formRequest === "view" ? "disabled" : ""}}>

                                        <option value="">{{ __("messages.dashboard.freight.form.fields.volume_units") }}</option>

                                        <option value="m3">{{ __("messages.common.cubic_meters") }}</option>
                                        <option value="mm3">{{ __("messages.common.cubic_milimeters") }}</option>
                                        <option value="cm3">{{ __("messages.common.cubic_centimeters") }}</option>
                                        <option value="in3">{{ __("messages.common.cubic_inches") }}</option>
                                    </select>
                                </div>
                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume') }} ({{ __('messages.common.optional') }}):</p>
                                    <input type="number" id="freight[{{$index}}][volume]" name="freight[{{$index}}][volume]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ $freight->volume ?? 0 }}" placeholder="{{ __("messages.dashboard.freight.form.fields.volume") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                </div>
                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.packages') }}:</p>
                                    <input type="text" id="freight[{{$index}}][packages]" name="freight[{{$index}}][packages]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{  $freight->packages ?? '' }}" placeholder="{{ __("messages.dashboard.freight.form.fields.packages") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                </div>
                                <div class="col-span-1 flex flex-col justify-start items-start">
                                    <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.incoterms') }}:</p>
                                    <input type="text" id="freight[{{$index}}][incoterms]" name="freight[{{$index}}][incoterms]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ $freight->incoterms ?? '' }}" placeholder="{{ __("messages.dashboard.freight.form.fields.incoterms") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </x-wrapper-scroll>

        <x-wrapper-scroll id="transport" title="messages.dashboard.tracking_step.plural">
            <div class="p-none">
                <div class="w-full h-auto flex flex-row justify-between py-none">
                    <label for="transports" class="block text-lg font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.tracking_step.name').'s' }}</label>
                    <button id="add_transport_btn" type="button" class="text-sm bg-primary hover:bg-primary-dark duration-300 p-2 rounded-full transition-all text-white border-2 border-primary hover:border-primary-dark active:scale-95 capitalize disabled:bg-gray-300 disabled:text-gray-200 disabled:cursor-pointer-none" {{ $formRequest === "view" ? "disabled" : "" }}>
                        {{__('messages.dashboard.tracking_step.add_entity')}}
                    </button>
                </div>

                <label for="defaults" class="block text-sm font-bold text-secondary-dark capitalize mt-2">Flujos Pre-Definidos</label>
                <div class="w-full h-auto flex flex-row justify-start gap-x-2 py-none pt-4 pb-2">
                    <button id="default_air_transport_btn" type="button" class="w-auto text-sm inline-flex justify-center items-center gap-x-2 bg-primary hover:bg-primary-dark duration-300 p-2 rounded-full transition-all text-white border-2 border-primary hover:border-primary-dark active:scale-95 capitalize disabled:bg-gray-300 disabled:text-gray-200 disabled:cursor-pointer-none" {{ $formRequest === "view" ? "disabled" : "" }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plane"><path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/></svg>
                        {{ __("messages.dashboard.transport_type.form.fields.AIR") }}
                    </button>

                    <button id="default_ship_transport_btn" type="button" class="text-sm inline-flex justify-center items-center gap-x-2 bg-primary hover:bg-primary-dark duration-300 p-2 rounded-full transition-all text-white border-2 border-primary hover:border-primary-dark active:scale-95 capitalize disabled:bg-gray-300 disabled:text-gray-200 disabled:cursor-pointer-none" {{ $formRequest === "view" ? "disabled" : "" }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ship"><path d="M12 10.189V14"/><path d="M12 2v3"/><path d="M19 13V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v6"/><path d="M19.38 20A11.6 11.6 0 0 0 21 14l-8.188-3.639a2 2 0 0 0-1.624 0L3 14a11.6 11.6 0 0 0 2.81 7.76"/><path d="M2 21c.6.5 1.2 1 2.5 1 2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1s1.2 1 2.5 1c2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1"/></svg>
                        {{ __("messages.dashboard.transport_type.form.fields.SHIP") }}
                    </button>
                    <button id="default_land_transport_btn" type="button" class="text-sm inline-flex justify-center items-center gap-x-2 bg-primary hover:bg-primary-dark duration-300 p-2 rounded-full transition-all text-white border-2 border-primary hover:border-primary-dark active:scale-95 capitalize disabled:bg-gray-300 disabled:text-gray-200 disabled:cursor-pointer-none" {{ $formRequest === "view" ? "disabled" : "" }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        {{ __("messages.dashboard.transport_type.form.fields.LAND") }}
                    </button>
                </div>

            </div>

            <label for="transports" class="block text-lg font-bold text-secondary-dark capitalize mb-4">{{ __('messages.dashboard.transport_type.name').'s' }}</label>

            <div class="step-tracks w-full h-auto flex flex-col gap-y-4">

                    @if($order)

                        @foreach ($order->trackingSteps as $index => $trackingStep)
                        <div class="step-track w-full h-auto flex flex-col items-start justify-start px-4 py-2 border-2 border-gray-200 rounded-xl">
                            <div class="w-full h-auto flex flex-row items-center justify-between z-[100]">
                                <div class="w-auto h-full flex flex-row justify-start items-center gap-x-2">
                                    <p class="step-track-correlative text-sm font-bold text-body">{{$index}}</p>
                                    <img id="step-track-icon-{{$index}}" onClick="updateTransportActiveState({{$index}})" src="{{ asset('storage/' . $trackingStep->transportType->icon) }}" class="step-track-icon h-12 w-12 shadow-md p-2  border-4 text-primary rounded-full duration-300 hover:border-primary cursor-pointer active:scale-95 {{ $trackingStep->status == 'IN_TRANSIT'? 'border-primary-dark' : ($trackingStep->status == 'COMPLETED' ? 'border-primary' : 'border-gray-light') }}" />
                                    <label id="step-track-label-{{$index}}" class="block text-sm font-bold text-secondary-dark capitalize">{{$trackingStep->transportType->name}}</label>
                                </div>

                                <div class="w-auto h-full flex flex-row justify-start items-center gap-x-2">

                                    <span id="toogle_down_wrap_content_transport_btn_{{$index}}" class="h-8 w-8 p-1 cursor-pointer duration-300 text-white rounded-full bg-primary hover:bg-primary-dark active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
                                    </span>

                                    <span id="toogle_up_wrap_content_transport_btn_{{$index}}" class="h-8 w-8 p-1 cursor-pointer duration-300 text-white rounded-full bg-primary hover:bg-primary-dark active:scale-95 hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-up"><path d="m18 15-6-6-6 6"/></svg>
                                    </span>

                                    <span class="text-gray-400 h-6 w-6 cursor-pointer hover:text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-justify"><path d="M3 12h18"/><path d="M3 18h18"/><path d="M3 6h18"/></svg>
                                    </span>
                                    <button id="delete_transport_btn_{{$index}}" onclick="this.closest('.step-track').remove(); updateTransportIndices()" type="button" class="h-8 w-8 bg-primary hover:bg-white text-white hover:text-primary duration-300 rounded-full p-1 border-2 border-primary active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="transports-wrapper-content-{{$index}} w-full h-[0] hidden opacity-0 grid grid-cols-2 text-body gap-y-2 border-2 border-gray-light rounded-xl gap-4 transition-all duration-300">

                                <label for="icon-tracking-step" class="block col-span-2 text-sm font-bold text-secondary-dark capitalize">
                                    {{ __("messages.dashboard.transport_type.form.fields.icon") }}
                                </label>

                                <!-- Country Field -->
                                <div class="col-span-1">
                                    <label for="transports[{{$index}}][country]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.tracking_step.form.fields.country") }}</label>
                                    <select id="transports[{{$index}}][country]" name="transports[{{$index}}][country]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" {{$formRequest === "view" ? "disabled" : ""}} value="{{$trackingStep->country ?? ''}}">
                                        <option value="">{{ __("messages.dashboard.tracking_step.form.placeholders.country") }}</option>
                                    </select>
                                </div>

                                <!-- City Field -->
                                <div class="col-span-1">
                                    <label for="transports[{{$index}}][city]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.tracking_step.form.fields.city") }}</label>
                                    <select id="transports[{{$index}}][city]" name="transports[{{$index}}][city]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" {{$formRequest === "view" ? "disabled" : ""}} value="{{$trackingStep->city ?? ''}}">
                                        <option value="">{{ __("messages.dashboard.tracking_step.form.placeholders.city") }}</option>
                                    </select>
                                    <input id="transports[{{$index}}][lat]" name="transports[{{$index}}][lat]" class="hidden"/>
                                    <input id="transports[{{$index}}][lng]" name="transports[{{$index}}][lng]" class="hidden"/>
                                </div>

                                <!-- Address Field -->
                                <div class="col-span-2">
                                    <label for="transports[{{$index}}][address]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.tracking_step.form.fields.address") }}</label>
                                    <input type="text" id="transports[{{$index}}][address]" name="transports[{{$index}}][address]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.tracking_step.form.placeholders.address") }}" {{$formRequest === "view" ? "disabled" : ""}} value="{{$trackingStep->address ?? ''}}">
                                </div>

                                <div class="col-span-2 flex flex-row gap-x-4">
                                    <select id="transports[{{$index}}][icon]" name="transports[{{$index}}][icon]" class="text-sm mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" {{ $formRequest === "view" ? "disabled" : "" }} value="{{$trackingStep->transportType->icon ?? ''}}" onchange="AddHandlerUpdateTrackIcon(this, {{$index}})">
                                        <option value="" disabled selected>{{ __("messages.dashboard.web.service.form.placeholders.icon") }}</option>

                                        @foreach($icons as $filename => $content)
                                            <option value="{{ $content }}" {{ old('icon', $service->icon ?? '') === $content ? 'selected' : '' }}>
                                                {{ $filename }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <img id="icon-tracking-step-image-{{$index}}" src="/storage/images/svgs/ambulance.svg" class="h-12 w-12 shadow-md rounded-xl p-2 border-2 border-primary text-primary"/>
                                </div>

                                <!-- Type Field -->
                                <div class="col-span-1">
                                    <label for="transports[{{$index}}][type]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.transport_type.form.fields.type") }}</label>
                                    <select id="transports[{{$index}}][type]" name="transports[{{$index}}][type]" class="text-sm mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body capitalize" placeholder="{{ __("messages.dashboard.transport_type.form.placeholders.type") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                        <option value="">{{ __("messages.dashboard.transport_type.form.fields.SELECT_TRANSPORT_TYPE") }}</option>

                                        <option value="LAND" {{ $trackingStep->transportType->type == 'LAND' ? 'selected' : '' }}>{{ __("messages.dashboard.transport_type.form.fields.LAND") }}</option>
                                        <option value="AIR" {{ $trackingStep->transportType->type == 'AIR' ? 'selected' : '' }}>{{ __("messages.dashboard.transport_type.form.fields.AIR") }}</option>
                                        <option value="SHIP" {{ $trackingStep->transportType->type == 'SHIP' ? 'selected' : '' }}>{{ __("messages.dashboard.transport_type.form.fields.SHIP") }}</option>

                                        <option value="CUSTOM" {{ $trackingStep->transportType->type == 'CUSTOM' ? 'selected' : '' }}>{{ __("messages.dashboard.transport_type.form.fields.CUSTOM") }}</option>
                                    </select>
                                </div>

                                <!-- Status Field -->
                                <div class="col-span-1">
                                    <label for="transports[{{$index}}][status]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.transport_type.form.fields.status") }}</label>
                                    <select id="transports[{{$index}}][status]" name="transports[{{$index}}][status]" onChange="updateTransportActiveState({{$index}}, this.value)"  class="text-sm mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body capitalize" placeholder="{{ __("messages.dashboard.transport_type.form.placeholders.status") }}" {{$formRequest === "view" ? "disabled" : ""}}>
                                        <option value="PENDING" {{$trackingStep->status == 'PENDING' ? 'selected' : ''}}>{{ __("messages.dashboard.order.form.fields.PENDING") }}</option>
                                        <option value="IN_TRANSIT" {{$trackingStep->status == 'IN_TRANSIT' ? 'selected' : ''}}>{{ __("messages.dashboard.order.form.fields.IN_TRANSIT") }}</option>
                                        <option value="COMPLETED" {{$trackingStep->status == 'COMPLETED' ? 'selected' : ''}}>{{ __("messages.dashboard.order.form.fields.COMPLETED") }}</option>
                                    </select>
                                </div>

                                <!-- Name Field -->
                                <div class="col-span-1">
                                    <label for="transports[{{$index}}][name]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.transport_type.form.fields.name") }}</label>
                                    <input type="text" id="transports[{{$index}}][name]" name="transports[{{$index}}][name]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.transport_type.form.placeholders.name") }}" {{$formRequest === "view" ? "disabled" : ""}} value="{{$trackingStep->transportType->name ?? ''}}">
                                </div>

                                <!-- EXt Reference Field -->
                                <div class="col-span-1">
                                    <label for="transports[{{$index}}][external_reference]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.transport_type.form.fields.external_reference") }} ({{ __('messages.common.optional') }}):</label>
                                    <input type="text" id="transports[{{$index}}][external_reference]" name="transports[{{$index}}][external_reference]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.transport_type.form.placeholders.external_reference") }}" {{$formRequest === "view" ? "disabled" : ""}} value="{{$trackingStep->transportType->external_reference ?? ''}}">
                                </div>

                                <!-- Eta Field -->
                                <div class="col-span-2">
                                    <label for="transports[{{$index}}][eta]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.tracking_step.form.fields.eta") }} ({{ __('messages.common.optional') }}):</label>
                                    <input type="datetime-local" id="transports[{{$index}}][eta]" name="transports[{{$index}}][eta]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.tracking_step.form.placeholders.eta") }}" {{$formRequest === "view" ? "disabled" : ""}} value="{{$trackingStep->eta ?? ''}}">
                                </div>

                                <div class="col-span-2">
                                    <label for="transports[{{$index}}][duration]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.tracking_step.form.fields.duration") }}:</label>
                                    <input type="number" step="1" id="transports[{{$index}}][duration]" name="transports[{{$index}}][duration]" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.tracking_step.form.placeholders.duration") }}" {{$formRequest === "view" ? "disabled" : ""}} value="{{$trackingStep->duration ?? 0}}">
                                </div>

                                <!-- Description Text Field -->
                                <div class="col-span-2">
                                    <label for="transports[{{$index}}][description]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.transport_type.form.fields.description') }}</label>
                                    <textarea id="transports[{{$index}}][description]" name="transports[{{$index}}][description]" rows="4" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.transport_type.form.placeholders.description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{$trackingStep->transportType->description ?? ''}}</textarea>
                                </div>
                            </div>
                            <input type="text" id="transports[{{$index}}][id]" name="transports[{{$index}}][id]" class="hidden" value="{{$trackingStep->transportType->id}}">
                        </div>
                        @endforeach
                    @endif
            </div>

        </x-wrapper-scroll>

        @if($formRequest == "create")
        <div class="w-full flex flex-row justify-between items-start gap-x-4 my-2">
            <p class="text-md text-body font-bold">{{ __('messages.dashboard.order.form.fields.mail') }}</p>
            <div class="checkbox-wrapper-2">
              <input type="checkbox" class="sc-gJwTLC ikxBAC" id="email-notification" name="email-notification">
            </div>
        </div>
        @endif

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

