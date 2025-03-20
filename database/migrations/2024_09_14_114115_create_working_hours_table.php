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
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->string('id_model')->nullable()->comment('id for model which whorking hours');
            $table->string('model_name')->nullable()->comment('name for model which whorking hours');
            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->tinyInteger('dynamic_work')->default(0)->comment("0 = hours - 1 = unregular - 2 = 24 hours");
            $table->tinyInteger('on_workrule')->default(0)->comment("0 = weekly - 1 = unregular - 2 = 7 days work");
            $table->json('work_days')->nullable()->comment("0 = Saturday - 1 = Sunday - 2 = Monday - 3 = Tuesday - 4 = Wednesday - 5 = Thursday - 6 =  Friday");
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
        Schema::dropIfExists('working_hours');
    }
};
