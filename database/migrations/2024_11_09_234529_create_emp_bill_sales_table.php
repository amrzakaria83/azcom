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
        Schema::create('emp_bill_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')
                    ->references('id')->on('bill_sale_details')->onDelete('cascade')->comment('sale_id');
            $table->unsignedBigInteger('empsaled_id')->nullable();
            $table->foreign('empsaled_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('empsaled_id');
            $table->unsignedBigInteger('sale_type_id')->nullable();
            $table->foreign('sale_type_id')
                    ->references('id')->on('sale_types')->onDelete('cascade')->comment('sale_type_id');
            $table->decimal('percent', 10, 3)->nullable();
            $table->decimal('value', 10, 3)->nullable();
            $table->string('note')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = active - 1 = notactive');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_bill_sales');
    }
};
