<div class="w-full h-auto grid grid-cols-2 text-body gap-y-2 border-2 border-gray-light rounded-xl p-4">
    <div class="col-span-2 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.name') }}:</p>
        <p>{{$freight->freight_id}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.name') }}:</p>
        <p>{{$freight->name}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.description') }}:</p>
        <p>{{$freight->description}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions_units') }}:</p>
        <p>{{$freight->dimensions_units}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.dimensions') }}:</p>
        <p>{{$freight->dimensions}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight_units') }}:</p>
        <p>{{$freight->weight_units}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.weight') }}:</p>
        <p>{{$freight->weight}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume_units') }}:</p>
        <p>{{$freight->volume_units}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.volume') }}:</p>
        <p>{{$freight->volume}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.packages') }}:</p>
        <p>{{$freight->packages}}</p>
    </div>
    <div class="col-span-1 flex flex-col justify-start items-start">
        <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.freight.form.fields.incoterms') }}:</p>
        <p>{{$freight->incoterms}}</p>
    </div>
</div>
