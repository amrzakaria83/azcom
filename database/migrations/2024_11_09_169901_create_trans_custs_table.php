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
        Schema::create('trans_custs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('cust_id')->nullable();
            $table->foreign('cust_id')
                ->references('id')->on('cut_sales')->onDelete('cascade')->comment('cust_id');
            $table->string('model_name')->nullable()->comment('name for model which chang amount');
            $table->string('id_model')->nullable()->comment('id for model which chang amount');
            $table->decimal('total_value', 10, 3)->nullable();
            $table->tinyInteger('status_trans')->nullable()->comment('0 = increased creadite - 1 = decreased creadite');
            $table->text('note')->nullable();
            $table->text('value_befor')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0 = active - 1 = notactive");
            $table->json('detal_cash')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trans_custs');
    }
};
