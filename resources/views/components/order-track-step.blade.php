@php
    $steps = $order->trackingSteps->sortBy('sequence')->values();
@endphp

<div class="w-full py-1">
    <div class="relative w-full grid grid-cols-1 sm:grid-cols-3 gap-2">
        @foreach ($steps as $index => $step)
            @php
                $isCompleted = $step->status === 'COMPLETED';
                $isInTransit = $step->status === 'IN_TRANSIT';
                $iconPath = storage_path('app/public/' . ($step->transportType->icon ?? ''));
                $rawSvg = (is_file($iconPath) && file_exists($iconPath)) ? file_get_contents($iconPath) : '';
                $cleanSvg = preg_replace('/<\?xml[^>]*\?>/i', '', $rawSvg);
                $cleanSvg = preg_replace('/\b(width|height)="[^"]*"/i', '', $cleanSvg);
                $cleanSvg = preg_replace('/<svg\b/i', '<svg width="14" height="14" style="width:14px;height:14px;display:block;flex-shrink:0;"', $cleanSvg, 1);

                $cardClasses = $isInTransit
                    ? 'bg-purple-50/90 border-primary shadow-2xs'
                    : ($isCompleted
                        ? 'bg-emerald-50/50 border-emerald-200/90 hover:border-emerald-300'
                        : 'bg-slate-50/80 border-slate-200/80 hover:border-slate-300');

                $iconWrapClasses = $isInTransit
                    ? 'bg-primary text-white'
                    : ($isCompleted
                        ? 'bg-emerald-600 text-white'
                        : 'bg-white text-slate-500 border border-slate-200');

                $badgeClasses = $isInTransit
                    ? 'bg-primary text-white'
                    : ($isCompleted
                        ? 'bg-emerald-100 text-emerald-800 border border-emerald-200'
                        : 'bg-slate-200/70 text-slate-600');

                $statusText = $isInTransit
                    ? 'En Tránsito'
                    : ($isCompleted ? 'Completado' : 'Pendiente');
            @endphp

            <div
                onClick="showOrderStatusModal({{$order->id}},{{$index}},'IN_TRANSIT','{{ __('messages.mail.modal.header') }}','{{ __('messages.mail.modal.send_status') }}','{{route('order.update.status',$order->id)}}','update')"
                title="Clic para actualizar estado de esta etapa"
                class="group relative flex flex-col justify-between rounded-xl border px-2.5 py-2 transition-all duration-200 cursor-pointer hover:border-primary {{ $cardClasses }}"
            >
                <div class="flex items-center justify-between gap-1.5 mb-1.5">
                    <div class="flex items-center gap-2 min-w-0">
                        <div class="relative w-6 h-6 rounded-lg flex items-center justify-center shrink-0 {{ $iconWrapClasses }}" style="width:26px;height:26px;">
                            @if($isInTransit)
                                <span class="absolute -top-0.5 -right-0.5 flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500 border border-white"></span>
                                </span>
                            @endif
                            {!! $cleanSvg !!}
                        </div>
                        <div class="min-w-0 leading-tight">
                            <span class="font-mono uppercase tracking-wider text-slate-400 block" style="font-size:9px;line-height:1.1;">
                                Etapa {{ $index + 1 }}
                            </span>
                            <span class="font-bold text-slate-900 block truncate" style="font-size:11px;line-height:1.25;" title="{{ $step->transportType->name ?? '' }}">
                                {{ $step->transportType->name ?? 'Tramo Logístico' }}
                            </span>
                        </div>
                    </div>

                    <span class="font-semibold px-1.5 py-0.5 rounded-md shrink-0 {{ $badgeClasses }}" style="font-size:9px;line-height:1.1;">
                        {{ $statusText }}
                    </span>
                </div>

                <div class="pt-1.5 border-t border-slate-200/60 flex items-center justify-between gap-1.5 text-slate-600" style="font-size:10px;line-height:1.2;">
                    <span class="truncate font-medium" title="{{ $step->city }}, {{ $step->country }}">
                        {{ $step->city }} · <span class="text-slate-400">{{ $step->country }}</span>
                    </span>
                    @if(is_numeric($step->lat) && is_numeric($step->lng))
                        <span class="font-mono text-slate-400 shrink-0" style="font-size:9px;">
                            {{ number_format((float)$step->lat, 2) }}°, {{ number_format((float)$step->lng, 2) }}°
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
