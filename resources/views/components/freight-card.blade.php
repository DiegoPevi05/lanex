<div class="w-full bg-slate-50/90 border border-slate-200/90 rounded-xl p-3 hover:border-purple-200 transition-colors">
    <div class="flex flex-wrap items-center justify-between gap-2 pb-2 mb-2 border-b border-slate-200/70">
        <div class="flex items-center gap-2">
            <span class="px-2 py-0.5 rounded-md bg-purple-100 text-primary font-mono font-bold" style="font-size:10px;">
                {{ $freight->freight_id }}
            </span>
            <span class="font-bold text-slate-900" style="font-size:11px;">
                {{ $freight->name }}
            </span>
        </div>
        @if(!empty($freight->incoterms))
            <span class="px-2 py-0.5 rounded-full bg-slate-900 text-white font-mono font-semibold uppercase tracking-wider" style="font-size:9px;">
                Incoterm: {{ $freight->incoterms }}
            </span>
        @endif
    </div>

    @if(!empty($freight->description))
        <span class="text-slate-600 mb-2.5 block" style="font-size:11px;line-height:1.35;">
            {{ $freight->description }}
        </span>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
        <div class="bg-white border border-slate-200/70 rounded-lg px-2 py-1">
            <span class="font-mono uppercase text-slate-400 block" style="font-size:9px;">Paquetes / Bultos</span>
            <span class="font-bold text-slate-800" style="font-size:11px;">{{ $freight->packages }} uds.</span>
        </div>
        <div class="bg-white border border-slate-200/70 rounded-lg px-2 py-1">
            <span class="font-mono uppercase text-slate-400 block" style="font-size:9px;">Peso Bruto</span>
            <span class="font-bold text-slate-800" style="font-size:11px;">{{ number_format((float)$freight->weight, 2) }} {{ $freight->weight_units }}</span>
        </div>
        <div class="bg-white border border-slate-200/70 rounded-lg px-2 py-1">
            <span class="font-mono uppercase text-slate-400 block" style="font-size:9px;">Volumen</span>
            <span class="font-bold text-slate-800" style="font-size:11px;">{{ number_format((float)$freight->volume, 2) }} {{ $freight->volume_units }}</span>
        </div>
        <div class="bg-white border border-slate-200/70 rounded-lg px-2 py-1">
            <span class="font-mono uppercase text-slate-400 block" style="font-size:9px;">Dimensiones</span>
            <span class="font-bold text-slate-800" style="font-size:11px;">{{ $freight->dimensions }} {{ $freight->dimensions_units }}</span>
        </div>
    </div>
</div>
