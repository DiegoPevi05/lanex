<?php
$svgContent = file_get_contents(storage_path('app/public/' . $transport_type->icon));
?>

<div id="content-card-{{$transport_type->getType()}}-{{$transport_type->id}}" class="w-full h-auto bg-white rounded-xl border border-slate-200/90 hover:border-purple-300 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition-all animation-element slide-in-up">
    <div class="flex items-start gap-3.5">
        <div class="w-10 h-10 rounded-xl bg-purple-50 border border-purple-200/60 flex items-center justify-center text-primary p-2 shrink-0">
            {!! $svgContent !!}
        </div>
        <div class="flex flex-col">
            <span class="font-mono text-[11px] font-bold text-primary uppercase">
                {{__('messages.dashboard.'.$transport_type->getType().'.card.header')}}: #{{$transport_type->id}}
            </span>
            <p class="font-bold text-sm text-slate-900 mt-0.5">{{$transport_type->name}}</p>
            <p class="text-xs text-slate-500 mt-0.5">
                {{ __('messages.dashboard.'.$transport_type->getType().'.card.status') }}:
                <span class="font-semibold text-slate-700">{{__('messages.common.'.$transport_type->status)}}</span>
            </p>
        </div>
    </div>

    <div class="flex sm:flex-col items-center sm:items-end justify-between gap-2 border-t sm:border-t-0 border-slate-100 pt-2.5 sm:pt-0">
        <span class="text-[11px] font-mono text-slate-400">
            {{ __('messages.dashboard.transport_type.card.updated') }}: {{$transport_type->updated_at->format('Y-m-d')}}
        </span>
        <div class="flex flex-row items-center gap-1.5">
            <span onClick='selectContent("{{$transport_type->id}}","{{$transport_type->getType()}}","view")' title="{{ __('Ver') }}" class="h-8 w-8 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1.5 hover:bg-primary hover:border-primary hover:text-white active:scale-95 transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
            </span>

            <span onClick='selectContent("{{$transport_type->id}}","{{$transport_type->getType()}}","update")' title="{{ __('Editar') }}" class="h-8 w-8 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1.5 hover:bg-primary hover:border-primary hover:text-white active:scale-95 transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
            </span>

            <span onClick='showDeleteModal("{{$transport_type->getHelperMessages()['delete_header']}}","{{$transport_type->getHelperMessages()['delete_content']}}","{{ route($transport_type->getRoutes()['destroy'], $transport_type->id) }}")' title="{{ __('Eliminar') }}" class="h-8 w-8 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1.5 hover:bg-red-600 hover:border-red-600 hover:text-white active:scale-95 transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </span>
        </div>
    </div>
</div>
<x-delete-modal :id="$transport_type->id" :deleteRoute="$transport_type->getRoutes()['destroy']"/>
