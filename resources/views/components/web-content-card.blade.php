<div id="web-content-card-{{$type}}-{{$id}}" class="w-full h-auto bg-white rounded-xl border border-slate-200/90 hover:border-purple-300 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 transition-all animation-element slide-in-up">
    <div class="flex flex-col min-w-0">
        <span class="font-mono text-[11px] font-bold text-primary uppercase">
            {{__('messages.dashboard.web.card.'.$type)}} #{{$id}}
        </span>
        <p class="text-sm font-bold text-slate-900 truncate mt-0.5">{{$preview}}</p>
    </div>

    <div class="flex sm:flex-col items-center sm:items-end justify-between gap-2 shrink-0 border-t sm:border-t-0 border-slate-100 pt-2.5 sm:pt-0">
        <span class="text-[11px] font-mono text-slate-400">
            {{$updated}}
        </span>
        <div class="flex flex-row items-center gap-1.5">
            <span onClick='selectContent("{{$id}}","{{$type}}","view")' title="{{ __('Ver') }}" class="h-8 w-8 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1.5 hover:bg-primary hover:border-primary hover:text-white active:scale-95 transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
            </span>

            <span onClick='selectContent("{{$id}}","{{$type}}","update")' title="{{ __('Editar') }}" class="h-8 w-8 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1.5 hover:bg-primary hover:border-primary hover:text-white active:scale-95 transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
            </span>

            <span onClick='showDeleteModal("{{$deleteMessages['delete_header']}}","{{$deleteMessages['delete_content']}}","{{route($deleteRoute, $id)}}","{{__('messages.common.delete')}}","delete")' title="{{ __('Eliminar') }}" class="h-8 w-8 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1.5 hover:bg-red-600 hover:border-red-600 hover:text-white active:scale-95 transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </span>
        </div>
    </div>
</div>
<x-delete-modal :id="$id"/>
