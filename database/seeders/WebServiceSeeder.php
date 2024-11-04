<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebService;
use App\Models\WebSupplier;
use App\Models\WebProduct;


class WebServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 random suppliers
        $suppliers = WebSupplier::factory(10)->create();

        // Create 6 services and attach them to random suppliers
        $services = WebService::factory(6)->create()->each(function ($service) use ($suppliers) {
            // Attach each service to 2 random suppliers (many-to-many)
            $randomSuppliers = $suppliers->random(2);
            $service->suppliers()->attach($randomSuppliers);

            // For each attached supplier, create and associate random products (many-to-many)
            $randomSuppliers->each(function ($supplier) {
                // Create 3 random products
                $products = WebProduct::factory(3)->create();

                // Attach each product to the supplier using the pivot table
                $supplier->products()->attach($products->pluck('id'));
            });
        });
    }
}
