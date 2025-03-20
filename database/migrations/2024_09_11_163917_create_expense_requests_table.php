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
        Schema::create('expense_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('emp_id_dirctor')->nullable();
            $table->foreign('emp_id_dirctor')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_id_dirctor');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
                    ->references('id')->on('type_expenses')->onDelete('cascade')->comment('type_id');
            $table->decimal('value', 10, 3)->nullable();
            $table->text('note')->nullable();
            $table->text('notepayment')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0 = active - 1 = not active ");
            $table->tinyInteger('statusresponse')->default(0)->comment("0 = waitting - 1 = approved - 2 = rejected - 3 = delayed ");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_requests');
    }
};
