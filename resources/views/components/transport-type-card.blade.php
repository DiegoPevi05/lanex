<?php
// Assuming $icon contains the file name or path within `storage`
$svgContent = file_get_contents(storage_path('app/public/' . $transport_type->icon));
?>

<div  id="content-card-{{$transport_type->getType()}}-{{$transport_type->id}}" class="w-full h-auto bg-white rounded-xl border-2 border-gray-light p-2 grid grid-cols-2 px-4 animation-element slide-in-up">
    <div class="col-span-1 flex flex-row">
        <div class="w-12 h-full mr-4 text-secondary-dark">
            {!! $svgContent !!}
        </div>
        <div class="w-auto flex flex-col">
            <p class="font-bold text-sm text-primary-dark capitalize">{{__('messages.dashboard.'.$transport_type->getType().'.card.header')}} : {{$transport_type->id}}</p>
            <p class="font-bold text-sm text-secondary-dark capitalize">{{ __('messages.dashboard.'.$transport_type->getType().'.card.name') }}</p>
            <p class="text-sm">{{$transport_type->name}}</p>
            <p class="font-bold text-sm text-secondary-dark capitalize">{{ __('messages.dashboard.'.$transport_type->getType().'.card.status') }}</p>
            <p class="text-sm">{{__('messages.common.'.$transport_type->status)}}</p>
        </div>
    </div>
    <div class="col-span-1 flex flex-col items-end">
        <p class="text-secondary-dark capitalize font-bold text-xs">{{ __('messages.dashboard.transport_type.card.updated') }}</p>
        <p class="text-xs">{{$transport_type->updated_at->format('Y-m-d')}}</p>
        <p class="text-secondary-dark capitalize font-bold text-xs mt-2 capitalize">{{ __('messages.dashboard.transport_type.card.actions') }}</p>
        <div class="flex flex-row w-auto gap-x-2 mt-1">
            <span  onClick='selectContent("{{$transport_type->id}}","{{$transport_type->getType()}}","view")' class="h-8 w-8 bg-white border-2 border-gray-light rounded-xl flex items-center justify-center text-secondary-dark p-1 hover:bg-primary hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
            </span>

            <span onClick='selectContent("{{$transport_type->id}}","{{$transport_type->getType()}}","update")' class="h-8 w-8 bg-white border-2 border-gray-light rounded-xl flex items-center justify-center text-secondary-dark p-1 hover:bg-primary hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
            </span>

            <span onClick='showDeleteModal("{{$transport_type->getHelperMessages()['delete_header']}}","{{$transport_type->getHelperMessages()['delete_content']}}")' class="h-8 w-8 bg-white border-2 border-gray-light rounded-xl flex items-center justify-center text-secondary-dark p-1 hover:bg-primary hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </span>

        </div>
    </div>
</div>
<x-delete-modal  :id="$transport_type->id" :deleteRoute="$transport_type->getRoutes()['destroy']"/>
