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
        Schema::table('bill_sale_headers', function (Blueprint $table) {
            $table->decimal('approv_sellprice', 10, 3)->nullable()->comment('note for user');
            $table->tinyInteger('status_requ')->default(0)->comment("0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied ");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill_sale_headers', function (Blueprint $table) {
            //
        });
    }
};
