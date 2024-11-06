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
        $transport_types = collect();

        for ($i = 0; $i < 12; $i++) {
            $transport_types->push(TransportType::factory()->withIndex($i)->create());
        }

        // Split transport types into two halves
        $first_half_transport_types = $transport_types->slice(0, 6)->values(); // First 6 transport types (index 0-5)
        $second_half_transport_types = $transport_types->slice(6, 6)->values(); // Last 6 transport types (index 6-11)

        // Create 4 orders and attach related data
        $orders = Order::factory(4)->create()->each(function ($order, $index) use ($first_half_transport_types, $second_half_transport_types) {

            $transport_group = $index < 2 ? $first_half_transport_types : $second_half_transport_types;

            $transport_index = 0;


            $tracking_steps = TrackingStep::factory(6)->make()->each(function ($tracking_step) use ($order, $transport_group, &$transport_index) {

                $tracking_step->transport_type_id = $transport_group[$transport_index]->id;
                $tracking_step->order_id = $order->id; // Set order_id directly
                $tracking_step->save();
                // Move to the next transport type, wrapping around if we reach the end
                $transport_index = ($transport_index + 1) % $transport_group->count();

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
