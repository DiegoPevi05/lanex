<?php
// Assuming $icon contains the file name or path within `storage`
$transportType = $order->getCurrentTrackStep()->transportType;
$svgContent = file_get_contents(storage_path('app/public/' . $transportType->icon ));
$currentTransportType = $transportType->type;
?>

<div id="content-card-{{$order->getType()}}-{{$order->id}}" class="w-full h-full border-2 border-gray-light rounded-xl animation-element slide-in-up">
    <div class="w-full h-auto flex flex-row justify-between items-center border-b-2 border-gray-light px-4 py-2">
        <div class="w-auto h-auto flex flex-row gap-x-4">
            <span class="font-bold text-body text-sm capitalize">
                {{ __('messages.dashboard.order.form.fields.order_number') }}:
            </span>
            <span class="fontb-bold text-secondary-dark text-sm">
                {{$order->order_number}}
            </span>
        </div>
        <div class="flex flex-row w-auto gap-x-2 mt-1">
            <span  onClick='selectContent("{{$order->id}}","{{$order->getType()}}","view")' class="h-8 w-8 bg-white border-2 border-gray-light rounded-xl flex items-center justify-center text-secondary-dark p-1 hover:bg-primary hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
            </span>

            <span onClick='selectContent("{{$order->id}}","{{$order->getType()}}","update")' class="h-8 w-8 bg-white border-2 border-gray-light rounded-xl flex items-center justify-center text-secondary-dark p-1 hover:bg-primary hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
            </span>

            <span onClick='showDeleteModal("{{$order->getHelperMessages()['delete_header']}}","{{$order->getHelperMessages()['delete_content']}}")' class="h-8 w-8 bg-white border-2 border-gray-light rounded-xl flex items-center justify-center text-secondary-dark p-1 hover:bg-primary hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </span>

        </div>
    </div>
    <div class="w-full h-auto flex flex-col justify-start items-start border-b-2 border-gray-light px-4 py-4">
        <div class="w-full flex flex-row">
            <div class="w-1/2 h-full flex flex-col justify-start items-start">
                <p class="text-secondary-dark">
                {{ __('messages.track.order.shipment') }}:
                </p>
            </div>
            <div class="w-1/2 h-full flex flex-col justify-start items-end">
                <span class="w-auto h-auto flex flex-row gap-x-2 items-center">
                    <div class="w-6 h-auto text-secondary-dark">
                        {!! $svgContent !!}
                    </div>
                    <p class="font-bold text-secondary-dark text-sm">
                        {{ $currentTransportType }}:
                    </p>
                </span>
            </div>
        </div>
        <div class="w-full flex flex-row mt-2 h-16">
            <div class="grid grid-cols-2 grid-rows-span w-1/2 relative">
                <div class="col-span-1 flex justify-center items-center">
                    <p>{{ __('messages.track.order.origin') }}</p>
                </div>
                <div class="col-span-1 text-secondary-dark flex justify-center items-center text-center px-4">
                    <p class="text-sm">{{ $order->getCurrentTrackStep()->country }}</p>
                </div>
                <div class="col-span-1 flex justify-center items-center">
                    <p>{{ __('messages.track.order.destiny') }}</p>
                </div>
                <div class="col-span-1 text-secondary-dark flex justify-center items-center text-center px-4">
                    <p class="text-sm">{{$order->getLastTrackStep()->country}}</p>
                </div>
                <div class="absolute w-[2px] h-[80%] bg-primary left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                    <div class="absolute w-[10px] h-[10px] bg-primary rounded-xl top-0 -translate-x-1/2"></div>
                    <div class="absolute w-[10px] h-[10px] bg-primary rounded-xl bottom-0 -translate-x-1/2"></div>
                </div>
            </div>
            <div class="w-2/4 h-full flex flex-col justify-start items-end gap-y-4">
                <p class="text-secondary-dark text-sm">{{ __('messages.track.order.destiny_city') }}</p>
                <span class="bg-primary rounded-xl w-auto px-4 py-1"><p class="text-white">{{ $order->getLastTrackStep()->city}}</p></span>

            </div>
        </div>
    </div>
    <x-content-wrapper :id="$order->id">
        <div class="w-full h-auto grid grid-cols-2 text-body gap-y-2">
            <div class="col-span-1 flex flex-col justify-start items-start">
                <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.order.form.fields.status') }}:</p>
                <p>{{__('messages.dashboard.order.form.fields.'. $order->status)}}</p>
            </div>
            <div class="col-span-1 flex flex-col justify-start items-start">
                <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.order.form.fields.details') }}:</p>
                <p>{{$order->details}}</p>
            </div>
            <div class="col-span-1 flex flex-col justify-start items-start">
                <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.order.form.fields.net_amount') }}:</p>
                <p>{{$order->net_amount}}</p>
            </div>
            <div class="col-span-1 flex flex-col justify-start items-start">
                <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.order.form.fields.taxes') }}:</p>
                <p>{{$order->taxes}}</p>
            </div>
            <div class="col-span-1 flex flex-col justify-start items-start">
                <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.order.form.fields.operative_cost') }}:</p>
                <p>{{$order->operative_cost}}</p>
            </div>
            <div class="col-span-1 flex flex-col justify-start items-start">
                <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.order.form.fields.numero_dam') }}:</p>
                <p>{{$order->numero_dam}}</p>
            </div>
            <div class="col-span-1 flex flex-col justify-start items-start">
                <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.order.form.fields.manifest') }}:</p>
                <p>{{$order->manifest}}</p>
            </div>
            <div class="col-span-1 flex flex-col justify-start items-start">
                <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.order.form.fields.channel') }}:</p>
                <p>{{$order->channel}}</p>
            </div>
            <div class="col-span-1 flex flex-col justify-start items-start">
                <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.order.form.fields.client_id') }}:</p>
                <p>{{$order->client_id}}</p>
            </div>
            <div class="col-span-2 flex flex-col justify-start items-start">
                <x-order-track-step :order="$order"/>
            </div>
            <div class="col-span-2 flex flex-col justify-start items-start mt-6">
                <p class="text-md font-bold text-secondary-dark capitalize inline-flex gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M22 7.7c0-.6-.4-1.2-.8-1.5l-6.3-3.9a1.72 1.72 0 0 0-1.7 0l-10.3 6c-.5.2-.9.8-.9 1.4v6.6c0 .5.4 1.2.8 1.5l6.3 3.9a1.72 1.72 0 0 0 1.7 0l10.3-6c.5-.3.9-1 .9-1.5Z"/><path d="M10 21.9V14L2.1 9.1"/><path d="m10 14 11.9-6.9"/><path d="M14 19.8v-8.1"/><path d="M18 17.5V9.4"/></svg>
                    {{ __('messages.dashboard.freight.name').'s' }}
                </p>
                <div class="w-full h-auto flex flex-col p-2 gap-y-4">
                    @foreach ($order->freights as $freight)
                        <x-freight-card :freight="$freight"/>
                    @endforeach
                </div>
            </div>
        </div>
    </x-content-wrapper>


</div>
<x-delete-modal  :id="$order->id" :deleteRoute="$order->getRoutes()['destroy']"/>