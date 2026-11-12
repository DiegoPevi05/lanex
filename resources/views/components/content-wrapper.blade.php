<div id="order_detail_{{$id}}" class="w-full h-auto px-3.5 py-2 bg-slate-50/60 border-t border-slate-100">
    <div class="w-full flex flex-row justify-between items-center">
        <span class="font-semibold text-slate-500 flex items-center gap-1.5" style="font-size:11px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" style="width:13px;height:13px;" class="text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            <span>Expediente Aduanero, Financiero y Manifiesto de Carga</span>
        </span>
        <button
            type="button"
            id="toggleButton_{{$id}}"
            onclick="toggleOrderDetailsAccordion('{{$id}}')"
            class="bg-white hover:bg-purple-50 text-slate-700 hover:text-primary border border-slate-200 hover:border-purple-200 rounded-lg py-1 px-2.5 font-semibold duration-200 active:scale-95 transition-all inline-flex gap-x-1 items-center cursor-pointer"
            style="font-size:11px;"
        >
            <span id="toggleLabel_{{$id}}">Ver Detalles</span>
            <svg id="iconOpen_{{$id}}" xmlns="http://www.w3.org/2000/svg" width="13" height="13" style="width:13px;height:13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
            <svg id="iconClose_{{$id}}" xmlns="http://www.w3.org/2000/svg" width="13" height="13" style="width:13px;height:13px;" class="hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 15-6-6-6 6"/></svg>
        </button>
    </div>
    <div id="detail_contaniner_{{$id}}" class="w-full hidden pt-2.5 pb-1 transition-all duration-300">
        <div id="detail_content_{{$id}}" class="w-full">
            {{ $slot }}
        </div>
    </div>
</div>

@once
<script>
    function toggleOrderDetailsAccordion(orderId) {
        const container = document.getElementById('detail_contaniner_' + orderId);
        const iconOpen = document.getElementById('iconOpen_' + orderId);
        const iconClose = document.getElementById('iconClose_' + orderId);
        const label = document.getElementById('toggleLabel_' + orderId);
        if (!container) return;

        const isHidden = container.classList.contains('hidden');
        if (isHidden) {
            container.classList.remove('hidden');
            if (iconOpen) iconOpen.classList.add('hidden');
            if (iconClose) iconClose.classList.remove('hidden');
            if (label) label.textContent = 'Ocultar Detalles';
        } else {
            container.classList.add('hidden');
            if (iconOpen) iconOpen.classList.remove('hidden');
            if (iconClose) iconClose.classList.add('hidden');
            if (label) label.textContent = 'Ver Detalles';
        }
    }
</script>
@endonce
