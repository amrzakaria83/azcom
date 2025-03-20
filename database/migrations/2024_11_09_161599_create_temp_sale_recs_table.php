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
        Schema::create('temp_sale_recs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('cut_sale_id')->nullable();
            $table->foreign('cut_sale_id')
                    ->references('id')->on('cut_sales')->onDelete('cascade')->comment('cut_sale_id');
            $table->unsignedBigInteger('sale_type_id')->nullable();
            $table->foreign('sale_type_id')
                    ->references('id')->on('sale_types')->onDelete('cascade')->comment('sale_type_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')
                    ->references('id')->on('products')->onDelete('cascade')->comment('product_id');
            $table->dateTime('valued_time', precision: 0)->nullable();
            $table->decimal('percent', 10, 3)->nullable();
            $table->decimal('quantityproduc', 10, 3)->nullable()->comment('note for user');
            $table->decimal('sellpriceproduct', 10, 3)->nullable()->comment('note for user');
            $table->decimal('sellpriceph', 10, 3)->nullable()->comment('note for user');
            $table->decimal('totalsellprice', 10, 3)->nullable()->comment('note for user');
            $table->text('note')->nullable();
            $table->text('method_for_payment')->nullable();
            $table->text('note1')->nullable();
            $table->text('note2')->nullable();
            $table->text('note3')->nullable();
            $table->text('status_order')->nullable();
            $table->tinyInteger('status_order_req')->default(0)->comment("0 = request - 1 = approved - 2 = cancel ");
            $table->text('parent_order')->nullable();
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
        Schema::dropIfExists('temp_sale_recs');
    }
};
