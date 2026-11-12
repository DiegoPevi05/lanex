<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Order;
use App\Services\FlightTracker;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('tracking:sync {--order= : Sync a specific order number}', function () {
    /** @var FlightTracker $tracker */
    $tracker = app(FlightTracker::class);

    $orderNumber = $this->option('order');
    $query = Order::where('canceled', false)->whereIn('status', ['IN_TRANSIT', 'IN TRANSIT', 'PENDING']);

    if (!empty($orderNumber)) {
        $query->whereRaw('LOWER(order_number) = ?', [strtolower($orderNumber)]);
    }

    $orders = $query->get();
    if ($orders->isEmpty()) {
        $this->info('No active orders found to sync.');
        return 0;
    }

    foreach ($orders as $order) {
        $telemetry = $tracker->syncOrderLiveTracking($order, true);
        if (!empty($telemetry)) {
            $this->info(sprintf(
                '[%s] Order %s (%s - %s) -> Lat: %s, Lng: %s | Speed: %s km/h (%s kn) | Heading: %d° | Progress: %s%%',
                $telemetry['synced_at'] ?? now()->toDateTimeString(),
                $order->order_number,
                $telemetry['mode'] ?? 'N/A',
                $telemetry['reference'] ?? 'N/A',
                $telemetry['lat'] ?? 0,
                $telemetry['lng'] ?? 0,
                $telemetry['speed_kmh'] ?? 0,
                $telemetry['speed_knots'] ?? 0,
                $telemetry['heading_deg'] ?? 0,
                $telemetry['progress_pct'] ?? 0
            ));
        }
    }

    return 0;
})->purpose('Synchronize real-time flight (OpenSky ADS-B) and vessel (AIS OpenSeaMap) positions for active orders');

Artisan::command('lanex:seed-production', function () {
    $this->info('Ejecutando LanexProductionSeeder para poblar servicios, marcas, productos, blogs y testimonios...');
    $this->call('db:seed', [
        '--class' => 'Database\\Seeders\\LanexProductionSeeder',
        '--force' => true,
    ]);
    $this->info('✓ Carga de producción completada.');
})->purpose('Carga todos los servicios, proveedores/marcas verificadas, productos y blogs de producción');


Schedule::command('tracking:sync')->everyMinute();
