
<div  id="web-content-card-{{$type}}-{{$id}}" class="w-full h-auto bg-white rounded-xl border-2 border-gray-light p-2 grid grid-cols-2 px-4 animation-element slide-in-up">
    <div class="col-span-1 flex flex-col">
        <p class="font-bold text-sm text-primary-dark capitalize">{{__('messages.dashboard.web.card.'.$type)}} : {{$id}}</p>
        <p class="font-bold text-primary capitalize">{{ __('messages.dashboard.web.card_content.preview') }}</p>
        <p class="text-sm">{{$preview}}</p>
    </div>
    <div class="col-span-1 flex flex-col items-end">
        <p class="text-secondary-dark capitalize font-bold text-xs">{{ __('messages.dashboard.web.card_content.date_content') }}</p>
        <p class="text-xs">{{$updated}}</p>
        <p class="text-secondary-dark capitalize font-bold text-xs mt-2 capitalize">{{ __('messages.dashboard.web.card_content.actions') }}</p>
        <div class="flex flex-row w-auto gap-x-2 mt-1">
            <span  onClick='selectContent("{{$id}}","{{$type}}","view")' class="h-8 w-8 bg-white border-2 border-gray-light rounded-xl flex items-center justify-center text-secondary-dark p-1 hover:bg-primary hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
            </span>

            <span onClick='selectContent("{{$id}}","{{$type}}","update")' class="h-8 w-8 bg-white border-2 border-gray-light rounded-xl flex items-center justify-center text-secondary-dark p-1 hover:bg-primary hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
            </span>

            <span onClick='showDeleteModal("{{$deleteMessages['delete_header']}}","{{$deleteMessages['delete_content']}}","{{route($deleteRoute, $id)}}","{{__('messages.common.delete')}}","delete")' class="h-8 w-8 bg-white border-2 border-gray-light rounded-xl flex items-center justify-center text-secondary-dark p-1 hover:bg-primary hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </span>

        </div>
    </div>
</div>
<x-delete-modal  :id="$id"/>
