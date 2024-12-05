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
        Schema::table('orders', function (Blueprint $table) {
            $table->float('taxes', 8, 2)->unsigned()->default(0)->change();
            $table->float('operative_cost', 8, 2)->unsigned()->default(0)->change();
            $table->unsignedBigInteger('numero_dam')->default(0)->change();
            $table->unsignedBigInteger('manifest')->default(0)->change();
            $table->unsignedBigInteger('channel')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->float('taxes', 8, 2)->unsigned()->change();
            $table->float('operative_cost', 8, 2)->unsigned()->change();
            $table->unsignedBigInteger('numero_dam')->change();
            $table->unsignedBigInteger('manifest')->change();
            $table->unsignedBigInteger('channel')->change();
        });
    }
};
