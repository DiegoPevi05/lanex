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
        @if($order->order_number)
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

