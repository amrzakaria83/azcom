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
        Schema::create('contact_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')
                    ->references('id')->on('contacts')->onDelete('cascade')->comment('contact_id');
            $table->unsignedBigInteger('rate_id')->nullable();
            $table->foreign('rate_id')
                    ->references('id')->on('ratings')->onDelete('cascade')->comment('rate_id');
            $table->text('value');
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
        Schema::dropIfExists('contact_rates');
    }
};
