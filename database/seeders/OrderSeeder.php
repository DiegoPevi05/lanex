<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Client;
use App\Models\TrackingStep;
use App\Models\TransportType;
use App\Models\Freight;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 random transport types
        $transport_types = TransportType::factory(10)->create();

        // Create 4 orders and attach related data
        $orders = Order::factory(4)->create()->each(function ($order) use ($transport_types) {

            $tracking_steps = TrackingStep::factory(5)->make()->each(function ($tracking_step) use ($order, $transport_types) {
                $transport = $transport_types->random();
                $tracking_step->order_id = $order->id; // Set order_id directly
                $tracking_step->transport_type_id = $transport->id; // Set transport_type_id directly
                $tracking_step->save();
            });

            // Create and associate freights with the order
            $freights = Freight::factory(2)->make()->each(function ($freight) use ($order) {
                $freight->order_id = $order->id; // Assuming a belongs-to relationship
                $freight->save();
            });

            // Create and associate clients with the order
            $clients = Client::factory(2)->create()->each(function ($client) use ($order) {
                $order->client_id = $client->id; // Assign the client's id to the order's client_id field
                $order->save(); // Save the order to persist the change
            });
        });
    }
}
