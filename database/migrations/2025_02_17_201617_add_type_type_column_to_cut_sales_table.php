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
        Schema::table('cut_sales', function (Blueprint $table) {
            $table->tinyInteger('type_type')->default(0)->comment("0 = center - 1 = newcustomer ");
            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')
                    ->references('id')->on('centers')->onDelete('cascade')->comment('center_id');
            $table->string('name_ar')->nullable();
            $table->string('tax_id')->nullable();
            $table->decimal('value', 10, 3)->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')
                    ->references('id')->on('areas')->onDelete('cascade')->comment('area_id');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id')
                    ->references('id')->on('cust_payment_methods')->onDelete('cascade')->comment('payment_method_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cut_sales', function (Blueprint $table) {
            //
        });
    }
};
