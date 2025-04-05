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
        Schema::create('refund_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('cust_id')->nullable();
            $table->foreign('cust_id')
                ->references('id')->on('cut_sales')->onDelete('cascade')->comment('cust_id');
            $table->unsignedBigInteger('prod_id')->nullable();
            $table->foreign('prod_id')
                    ->references('id')->on('products')->onDelete('cascade')->comment('prod_id');
            $table->unsignedBigInteger('bill_sale_header_id')->nullable();
            $table->foreign('bill_sale_header_id')
                    ->references('id')->on('bill_sale_headers')->onDelete('cascade')->comment('bill_sale_header_id');
            $table->decimal('approv_quantity_ref', 10, 3)->nullable()->comment('note for user');
            $table->decimal('approv_sellpriceproduct_ref', 10, 3)->nullable()->comment('note for user');
            $table->decimal('approv_percent_ref', 10, 3)->nullable()->comment('note for user');
            $table->tinyInteger('status_requ_ref')->nullable()->comment("0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = done ");
            $table->unsignedBigInteger('refund_causes_id')->nullable();
            $table->foreign('refund_causes_id')
                    ->references('id')->on('refund_causes')->onDelete('cascade')->comment('refund_causes_id');
            $table->text('parent_id')->nullable();
            $table->decimal('value', 10, 3)->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0 = active - 1 = notactive");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_sales');
    }
};
