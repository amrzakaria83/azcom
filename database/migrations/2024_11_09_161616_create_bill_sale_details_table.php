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
        Schema::create('bill_sale_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')
                    ->references('id')->on('products')->onDelete('cascade')->comment('product_id');
            $table->unsignedBigInteger('bill_sale_header_id')->nullable();
            $table->foreign('bill_sale_header_id')
                    ->references('id')->on('bill_sale_headers')->onDelete('cascade')->comment('bill_sale_header_id');
            $table->decimal('quantityproduc', 10, 3)->nullable()->comment('note for user');
            $table->decimal('sellpriceproduct', 10, 3)->nullable()->comment('note for user');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0 = active - 1 = not active ");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_sale_details');
    }
};
