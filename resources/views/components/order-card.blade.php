<?php
$currentStep = $order->getCurrentTrackStep();
$firstStep = $order->getFirstTrackStep();
$lastStep = $order->getLastTrackStep();
$transportType = $currentStep ? $currentStep->transportType : null;
$iconFile = $transportType && $transportType->icon ? storage_path('app/public/' . $transportType->icon) : null;
$rawSvg = ($iconFile && is_file($iconFile) && file_exists($iconFile)) ? file_get_contents($iconFile) : '';
$svgContent = preg_replace('/<\?xml[^>]*\?>/i', '', $rawSvg);
$svgContent = preg_replace('/\b(width|height)="[^"]*"/i', '', $svgContent);
$svgContent = preg_replace('/<svg\b/i', '<svg width="13" height="13" style="width:13px;height:13px;display:block;flex-shrink:0;"', $svgContent, 1);

$currentTransportType = $transportType ? $transportType->type : 'SHIP';
$externalRef = $transportType ? ($transportType->external_reference ?? '') : '';

$stepsCollection = $order->trackingSteps ?? collect();
$totalStepsCount = max(1, count($stepsCollection));
$lastIndex = $totalStepsCount - 1;

$completedCount = 0;
$hasInTransit = false;
foreach ($stepsCollection as $s) {
    if ($s->status === 'COMPLETED') {
        $completedCount++;
    } elseif ($s->status === 'IN_TRANSIT') {
        $hasInTransit = true;
    }
}
$progressPercent = (int) round((($completedCount + ($hasInTransit ? 0.6 : 0)) / $totalStepsCount) * 100);
if ($order->status === 'COMPLETED') {
    $progressPercent = 100;
}

$statusBadgeClass = match ($order->status) {
    'COMPLETED' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'IN TRANSIT', 'IN_TRANSIT' => 'bg-purple-50 text-primary border-purple-200',
    default => 'bg-amber-50 text-amber-700 border-amber-200',
};
$statusDotClass = match ($order->status) {
    'COMPLETED' => 'bg-emerald-500',
    'IN TRANSIT', 'IN_TRANSIT' => 'bg-emerald-500 animate-pulse',
    default => 'bg-amber-500',
};

$totalPackages = 0;
$totalWeight = 0;
foreach ($order->freights ?? [] as $f) {
    $totalPackages += (int) ($f->packages ?? 0);
    $totalWeight += (float) ($f->weight ?? 0);
}
$isCompactDashboard = ($type == "dashboard");
?>

<div id="content-card-{{$order->getType()}}-{{$order->id}}" class="w-full h-auto bg-white border border-slate-200/90 hover:border-purple-300 shadow-2xs hover:shadow-sm rounded-xl transition-all duration-200 animation-element slide-in-up overflow-hidden">
    <!-- Top Header Bar -->
    <div class="w-full h-auto flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-slate-100 bg-slate-50/80 px-3.5 py-2.5 gap-2">
        <div class="flex flex-wrap items-center gap-1.5">
            <span class="font-mono font-bold text-primary bg-purple-50 border border-purple-200/80 px-2 py-0.5 rounded-md" style="font-size:11px;line-height:1.3;">
                #{{$order->order_number}}
            </span>

            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md border font-bold uppercase tracking-wide {{ $statusBadgeClass }}" style="font-size:10px;line-height:1.3;">
                <span class="w-1.5 h-1.5 rounded-full {{ $statusDotClass }}"></span>
                <span>{{ __('messages.dashboard.order.form.fields.' . $order->status) }}</span>
            </span>

            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-white border border-slate-200/80 text-slate-700 font-semibold" style="font-size:11px;line-height:1.3;">
                <span class="text-primary inline-flex items-center justify-center shrink-0" style="width:13px;height:13px;">{!! $svgContent !!}</span>
                <span>{{ __('messages.dashboard.transport_type.form.fields.' . $currentTransportType) }}</span>
            </span>

            <span class="font-semibold text-slate-700 inline-flex items-center gap-1 pl-0.5" style="font-size:11px;line-height:1.3;">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" style="width:13px;height:13px;" class="text-slate-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                <span class="truncate max-w-[180px] sm:max-w-[260px]">{{ $order->client_name }}</span>
            </span>
        </div>

        <div class="flex flex-wrap items-center gap-1">
            <!-- 1-Click Live GPS / Transponder Sync -->
            <button
                type="button"
                onclick="syncOrderCardGps('{{$order->order_number}}', '{{$order->id}}', this)"
                title="Sincronizar posición GPS en tiempo real (OpenSky ADS-B / Marine AIS)"
                class="h-7 px-2 bg-emerald-50 border border-emerald-200 rounded-lg inline-flex items-center justify-center gap-1 text-emerald-700 font-semibold hover:bg-emerald-600 hover:border-emerald-600 hover:text-white active:scale-95 transition-all cursor-pointer"
                style="font-size:11px;"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" style="width:13px;height:13px;" class="sync-icon shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>
                <span class="sync-label">{{ $isCompactDashboard ? 'GPS' : 'Sincronizar GPS' }}</span>
            </button>

            <a href="{{ route('track', ['order' => $order->order_number]) }}" target="_blank" title="Abrir Mapa y Telemetría en Tiempo Real" class="h-7 px-2 bg-purple-50 border border-purple-200 rounded-lg inline-flex items-center justify-center gap-1 text-primary font-semibold hover:bg-primary hover:border-primary hover:text-white active:scale-95 transition-all cursor-pointer" style="font-size:11px;">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>{{ $isCompactDashboard ? 'Mapa' : 'Mapa en Vivo' }}</span>
            </a>

            @if($type == "default")
                <span onClick='selectContent("{{$order->id}}","{{$order->getType()}}","view")' title="Ver orden en overlay" class="h-7 w-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1 hover:bg-primary hover:border-primary hover:text-white active:scale-95 transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                </span>

                <span onClick='selectContent("{{$order->id}}","{{$order->getType()}}","update")' title="Editar orden en overlay" class="h-7 w-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1 hover:bg-primary hover:border-primary hover:text-white active:scale-95 transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                </span>

                <span onClick='showDeleteModal("{{$order->getHelperMessages()['cancel_header']}}","{{$order->getHelperMessages()['cancel_content']}}","{{ route($order->getRoutes()['cancel'],$order->id)}}","{{$order->getHelperMessages()['cancel_btn_label']}}","cancel")' title="Cancelar orden" class="h-7 w-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1 hover:bg-amber-600 hover:border-amber-600 hover:text-white active:scale-95 transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                </span>

                <span onClick='showDeleteModal("{{$order->getHelperMessages()['delete_header']}}","{{$order->getHelperMessages()['delete_content']}}","{{ route($order->getRoutes()['destroy'], $order->id) }}","{{$order->getHelperMessages()['delete_btn_label']}}","delete")' title="Eliminar orden" class="h-7 w-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1 hover:bg-red-600 hover:border-red-600 hover:text-white active:scale-95 transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </span>
            @endif

            <span onClick="showOrderCustomEmailModal({{$order->id}},'{{ route('order.email', $order->id) }}')" title="Enviar notificación por correo" class="h-7 w-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1 hover:bg-primary hover:border-primary hover:text-white active:scale-95 transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </span>

            @if($type == "history")
                <span onClick="showRestoreOrderModal({{$order->id}},'{{ route('order.restore', $order->id) }}')" title="Restaurar orden" class="h-7 w-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1 hover:bg-primary hover:border-primary hover:text-white active:scale-95 transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="5" x="2" y="3" rx="1"/><path d="M4 8v11a2 2 0 0 0 2 2h2"/><path d="M20 8v11a2 2 0 0 1-2 2h-2"/><path d="m9 15 3-3 3 3"/><path d="M12 12v9"/></svg>
                </span>
            @endif

            @if($type == "dashboard" || $type == "default")
                <span onClick="showOrderStatusModal({{$order->id}},{{$lastIndex}}, 'COMPLETED','{{ __("messages.mail.modal.header_complete") }}', '{{ __("messages.mail.modal.complete_status") }}','{{ route('order.update.status', $order->id) }}', 'complete')" title="Marcar orden como completada" class="h-7 w-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 p-1 hover:bg-emerald-600 hover:border-emerald-600 hover:text-white active:scale-95 transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m16 16 2 2 4-4"/><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
                </span>
            @endif
        </div>
    </div>

    <!-- Route Corridor, Live Transponder Strip & Progress Bar -->
    <div class="w-full flex flex-col px-3.5 py-2.5 gap-2 border-b border-slate-100">
        <!-- Origin -> Current -> Destination -->
        <div class="w-full grid grid-cols-1 md:grid-cols-12 items-center gap-2">
            <div class="md:col-span-7 flex items-center gap-2">
                <div class="flex-1 min-w-0 px-2.5 py-1.5 rounded-lg bg-slate-50 border border-slate-200/80">
                    <span class="font-mono uppercase tracking-wider text-slate-400 block" style="font-size:9px;line-height:1.1;">
                        {{ __('messages.track.order.from') }}
                    </span>
                    <span class="font-bold text-slate-900 block truncate" style="font-size:11px;line-height:1.25;" title="{{ $firstStep->city ?? '' }}, {{ $firstStep->country ?? '' }}">
                        {{ $firstStep->city ?? 'Origen' }}
                    </span>
                    <span class="text-slate-500 font-medium block truncate" style="font-size:10px;line-height:1.15;">
                        {{ $firstStep->country ?? '' }}
                    </span>
                </div>

                <div class="flex flex-col items-center justify-center px-0.5 text-primary shrink-0">
                    <span class="font-mono font-bold text-primary" style="font-size:10px;" id="card-progress-label-{{$order->id}}">{{ $progressPercent }}%</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </div>

                <div class="flex-1 min-w-0 px-2.5 py-1.5 rounded-lg bg-slate-50 border border-slate-200/80">
                    <span class="font-mono uppercase tracking-wider text-slate-400 block" style="font-size:9px;line-height:1.1;">
                        {{ __('messages.track.order.to') }}
                    </span>
                    <span class="font-bold text-slate-900 block truncate" style="font-size:11px;line-height:1.25;" title="{{ $lastStep->city ?? '' }}, {{ $lastStep->country ?? '' }}">
                        {{ $lastStep->city ?? 'Destino' }}
                    </span>
                    <span class="text-slate-500 font-medium block truncate" style="font-size:10px;line-height:1.15;">
                        {{ $lastStep->country ?? '' }}
                    </span>
                </div>
            </div>

            <!-- Active Location / Live Telemetry Box -->
            <div class="md:col-span-5 flex flex-col justify-between px-3 py-1.5 rounded-lg bg-slate-900 text-white border border-slate-800">
                <div class="flex items-center justify-between gap-1.5">
                    <span class="font-mono uppercase tracking-wider text-purple-300 flex items-center gap-1" style="font-size:9px;line-height:1.2;">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>TELEMETRÍA EN VIVO</span>
                    </span>
                    <span id="card-live-speed-{{$order->id}}" class="font-mono text-emerald-400 font-semibold" style="font-size:9px;line-height:1.2;">
                        {{ $currentTransportType === 'AIR' ? 'OpenSky ADS-B' : ($currentTransportType === 'SHIP' ? 'Marine AIS' : 'GPS Activo') }}
                    </span>
                </div>
                <span id="card-live-city-{{$order->id}}" class="font-bold text-white truncate block mt-0.5" style="font-size:11px;line-height:1.25;" title="{{ $currentStep->city ?? '' }}">
                    {{ $currentStep->city ?? 'En ruta internacional' }}
                </span>
                <div class="flex items-center justify-between gap-2 mt-1 pt-1 border-t border-slate-800 font-mono text-slate-300" style="font-size:9px;line-height:1.15;">
                    <span id="card-live-coords-{{$order->id}}" class="shrink-0">
                        @if($currentStep && is_numeric($currentStep->lat) && is_numeric($currentStep->lng))
                            GPS: {{ number_format((float)$currentStep->lat, 3) }}°, {{ number_format((float)$currentStep->lng, 3) }}°
                        @else
                            GPS: Activo
                        @endif
                    </span>
                    <span id="card-live-ref-{{$order->id}}" class="truncate text-purple-300" title="{{ $externalRef }}">
                        {{ $externalRef ?: ($transportType->name ?? '') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-slate-100 h-1 rounded-full overflow-hidden">
            <div id="card-progress-bar-{{$order->id}}" class="bg-gradient-to-r from-primary to-emerald-500 h-full rounded-full transition-all duration-500" style="width: {{ $progressPercent }}%"></div>
        </div>

        @if(!$isCompactDashboard)
            <!-- Quick KPI Summary Pills (Shown on full-width /dashboard/order page) -->
            <div class="w-full grid grid-cols-2 sm:grid-cols-4 gap-2 pt-0.5">
                <div class="px-2.5 py-1 rounded-lg bg-slate-50 border border-slate-200/70 flex items-center justify-between">
                    <span class="font-mono uppercase text-slate-400" style="font-size:9px;">Monto Neto</span>
                    <span class="font-mono font-bold text-slate-900" style="font-size:11px;">${{ number_format((float)$order->net_amount, 2) }}</span>
                </div>
                <div class="px-2.5 py-1 rounded-lg bg-slate-50 border border-slate-200/70 flex items-center justify-between">
                    <span class="font-mono uppercase text-slate-400" style="font-size:9px;">N° DAM</span>
                    <span class="font-mono font-semibold text-slate-800" style="font-size:11px;">{{ $order->numero_dam ?: '—' }}</span>
                </div>
                <div class="px-2.5 py-1 rounded-lg bg-slate-50 border border-slate-200/70 flex items-center justify-between">
                    <span class="font-mono uppercase text-slate-400" style="font-size:9px;">Manifiesto</span>
                    <span class="font-mono font-semibold text-slate-800" style="font-size:11px;">{{ $order->manifest ?: '—' }}</span>
                </div>
                <div class="px-2.5 py-1 rounded-lg bg-slate-50 border border-slate-200/70 flex items-center justify-between">
                    <span class="font-mono uppercase text-slate-400" style="font-size:9px;">Carga Total</span>
                    <span class="font-semibold text-slate-800" style="font-size:11px;">{{ $totalPackages }} bultos · {{ number_format($totalWeight, 0) }} kg</span>
                </div>
            </div>
        @endif
    </div>

    <!-- Interactive Stepper Timeline -->
    <div class="w-full px-3.5 py-2 bg-white">
        <x-order-track-step :order="$order"/>
    </div>

    <!-- Expandable Full Details & Cargo Manifest -->
    @if($type != "dashboard")
        <x-content-wrapper :id="$order->id">
            <div class="w-full flex flex-col gap-2.5">
                @if(!empty($order->details))
                    <div class="w-full bg-white border border-slate-200/80 rounded-xl p-2.5">
                        <span class="font-mono uppercase tracking-wider text-slate-400 block mb-0.5" style="font-size:9px;">
                            {{ __('messages.dashboard.order.form.fields.details') }}
                        </span>
                        <span class="text-slate-700 font-medium block" style="font-size:11px;line-height:1.4;">{{ $order->details }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                    <div class="bg-white border border-slate-200/80 rounded-xl p-2">
                        <span class="font-mono uppercase text-slate-400 block" style="font-size:9px;">{{ __('messages.dashboard.order.form.fields.net_amount') }}</span>
                        <span class="font-mono font-bold text-slate-900" style="font-size:11px;">${{ number_format((float)$order->net_amount, 2) }}</span>
                    </div>
                    <div class="bg-white border border-slate-200/80 rounded-xl p-2">
                        <span class="font-mono uppercase text-slate-400 block" style="font-size:9px;">{{ __('messages.dashboard.order.form.fields.taxes') }}</span>
                        <span class="font-mono font-semibold text-slate-800" style="font-size:11px;">${{ number_format((float)$order->taxes, 2) }}</span>
                    </div>
                    <div class="bg-white border border-slate-200/80 rounded-xl p-2">
                        <span class="font-mono uppercase text-slate-400 block" style="font-size:9px;">{{ __('messages.dashboard.order.form.fields.operative_cost') }}</span>
                        <span class="font-mono font-semibold text-slate-800" style="font-size:11px;">${{ number_format((float)$order->operative_cost, 2) }}</span>
                    </div>
                    <div class="bg-white border border-slate-200/80 rounded-xl p-2">
                        <span class="font-mono uppercase text-slate-400 block" style="font-size:9px;">{{ __('messages.dashboard.order.form.fields.channel') }}</span>
                        <span class="font-mono font-semibold text-slate-800" style="font-size:11px;">Canal {{ $order->channel }}</span>
                    </div>
                </div>

                @if(count($order->freights ?? []) > 0)
                    <div class="w-full flex flex-col gap-2 pt-1">
                        <span class="font-bold text-slate-800 inline-flex items-center gap-1.5" style="font-size:11px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" style="width:14px;height:14px;" class="text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 7.7c0-.6-.4-1.2-.8-1.5l-6.3-3.9a1.72 1.72 0 0 0-1.7 0l-10.3 6c-.5.2-.9.8-.9 1.4v6.6c0 .5.4 1.2.8 1.5l6.3 3.9a1.72 1.72 0 0 0 1.7 0l10.3-6c.5-.3.9-1 .9-1.5Z"/><path d="M10 21.9V14L2.1 9.1"/><path d="m10 14 11.9-6.9"/></svg>
                            <span>Manifiesto de Mercancías ({{ count($order->freights) }})</span>
                        </span>
                        <div class="w-full flex flex-col gap-2">
                            @foreach ($order->freights as $freight)
                                <x-freight-card :freight="$freight"/>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </x-content-wrapper>
    @endif
</div>
<x-delete-modal :id="$order->id"/>

@once
<script>
    async function syncOrderCardGps(orderNumber, orderId, btnEl) {
        const icon = btnEl ? btnEl.querySelector('.sync-icon') : null;
        const label = btnEl ? btnEl.querySelector('.sync-label') : null;
        const prevText = label ? label.textContent : 'GPS';
        if (icon) icon.classList.add('animate-spin');
        if (label) label.textContent = '...';

        try {
            const res = await fetch(`/track/order?order_number=${encodeURIComponent(orderNumber)}&sync=1`, {
                headers: { 'Accept': 'application/json' }
            });
            if (!res.ok) throw new Error('Error HTTP ' + res.status);
            const data = await res.json();
            const tel = data.live_telemetry || {};
            const coordsEl = document.getElementById('card-live-coords-' + orderId);
            const speedEl = document.getElementById('card-live-speed-' + orderId);
            const refEl = document.getElementById('card-live-ref-' + orderId);
            const cityEl = document.getElementById('card-live-city-' + orderId);

            if (coordsEl && tel.lat !== undefined && tel.lng !== undefined) {
                coordsEl.textContent = `GPS: ${Number(tel.lat).toFixed(3)}°, ${Number(tel.lng).toFixed(3)}°`;
            }
            if (speedEl && tel.speed_kmh !== undefined) {
                speedEl.textContent = `${tel.speed_kmh} km/h (${tel.speed_knots} kn)`;
            }
            if (refEl && tel.name) {
                refEl.textContent = tel.name;
                refEl.title = tel.name;
            }
            if (cityEl && tel.status_label) {
                cityEl.textContent = tel.status_label;
            }
            if (typeof showToast === 'function') {
                showToast([`GPS sincronizado en vivo (${orderNumber}): ${tel.lat}°, ${tel.lng}°`]);
            }
        } catch (e) {
            console.error(e);
        } finally {
            if (icon) icon.classList.remove('animate-spin');
            if (label) label.textContent = prevText;
        }
    }
</script>
@endonce
