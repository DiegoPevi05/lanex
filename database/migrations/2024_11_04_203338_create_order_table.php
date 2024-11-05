<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->string('status')->default('PENDING'); // e.g., "Pending", "In Transit", "Completed"
            $table->text('details');
            $table->float('net_amount', 8, 2)->unsigned();  // Adds unsigned for positive values only
            $table->float('taxes', 8, 2)->unsigned();       // Adjust precision and scale if needed
            $table->float('operative_cost', 8, 2)->unsigned();
            $table->unsignedBigInteger('numero_dam');
            $table->unsignedBigInteger('manifest');
            $table->unsignedBigInteger('channel');
            $table->unsignedBigInteger('client_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
