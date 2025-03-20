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
        Schema::create('event_atts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('empatt_id')->nullable();
            $table->foreign('empatt_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('empatt_id');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')
                    ->references('id')->on('events')->onDelete('cascade')->comment('event_id');
            $table->text('checkin_location')->nullable();
            $table->dateTime('from_time', precision: 0)->nullable();
            $table->text('checkout_location')->nullable();
            $table->dateTime('end_time', precision: 0)->nullable();
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
        Schema::dropIfExists('event_atts');
    }
};
