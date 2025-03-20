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
        Schema::create('plan_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('emphplan_id')->nullable();
            $table->foreign('emphplan_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emphplan_id');
            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')
                    ->references('id')->on('centers')->onDelete('cascade')->comment('center_id');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')
                    ->references('id')->on('contacts')->onDelete('cascade')->comment('contact_id');
            $table->unsignedBigInteger('typevist_id')->nullable();
            $table->foreign('typevist_id')
                    ->references('id')->on('type_visits')->onDelete('cascade')->comment('typevist_id');
            $table->dateTime('from_time', precision: 0)->nullable();
            $table->tinyInteger('status_visit')->default(0)->comment('0 = single visit - 1 = double visit - 2 = triple visit');
            $table->json('visit_emp_ass')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status_planvisit_list')->nullable()->comment('0 = listed contact - 1 = listed center - 2 = both - 3 = out list ');
            $table->tinyInteger('status_return')->default(0)->comment('0 = done - 1 = canceld - 3 = delayed - 4 = planned');
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
        Schema::dropIfExists('plan_visits');
    }
};
