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
        Schema::table('freights', function (Blueprint $table) {
            // Rename columns from 'weigth' to 'weight' and 'weigth_units' to 'weight_units'
            $table->renameColumn('weigth', 'weight');
            $table->renameColumn('weigth_units', 'weight_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freights', function (Blueprint $table) {
            // Revert the column names back to 'weigth' and 'weigth_units'
            $table->renameColumn('weight', 'weigth');
            $table->renameColumn('weight_units', 'weigth_units');
        });
    }
};
