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
        Schema::table('bill_sale_details', function (Blueprint $table) {
            $table->decimal('approv_quantity', 10, 3)->nullable()->comment('note for user');
            $table->decimal('approv_sellpriceproduct', 10, 3)->nullable()->comment('note for user');
            $table->decimal('approv_percent', 10, 3)->nullable()->comment('note for user');
            $table->tinyInteger('status_requ')->nullable()->comment("0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied ");
            $table->decimal('percent', 10, 3)->nullable();
            $table->decimal('sellpriceph', 10, 3)->nullable()->comment('note for user');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill_sale_details', function (Blueprint $table) {
            //
        });
    }
};
