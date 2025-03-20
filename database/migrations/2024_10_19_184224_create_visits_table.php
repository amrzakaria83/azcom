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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('empvisit_id')->nullable();
            $table->foreign('empvisit_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('empvisit_id');
            $table->unsignedBigInteger('typevist_id')->nullable();
            $table->foreign('typevist_id')
                    ->references('id')->on('type_visits')->onDelete('cascade')->comment('typevist_id');
            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')
                    ->references('id')->on('centers')->onDelete('cascade')->comment('center_id');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')
                    ->references('id')->on('contacts')->onDelete('cascade')->comment('contact_id');
            $table->tinyInteger('status_visit')->default(0)->comment('0 = single visit - 1 = double visit - 2 = triple visit');
            $table->unsignedBigInteger('firstprodstep_id')->nullable();
            $table->foreign('firstprodstep_id')
                    ->references('id')->on('products')->onDelete('cascade')->comment('firstprodstep_id');
            $table->tinyInteger('first_type')->nullable()->comment("0 = details - 1 = reminder "); 
            $table->unsignedBigInteger('secondprodstep_id')->nullable();
            $table->foreign('secondprodstep_id')
                    ->references('id')->on('products')->onDelete('cascade')->comment('secondprodstep_id');
            $table->tinyInteger('second_type')->nullable()->comment("0 = details - 1 = reminder ");
            $table->unsignedBigInteger('thirdprodstep_id')->nullable();
            $table->foreign('thirdprodstep_id')
                    ->references('id')->on('products')->onDelete('cascade')->comment('thirdprodstep_id');
            $table->tinyInteger('third_type')->nullable()->comment("0 = details - 1 = reminder ");
        //     $table->json('product_id')->nullable();
            $table->json('visit_emp_ass')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status_return')->default(0)->comment('0 = planned - 1 = randum ');
            $table->tinyInteger('status_visit_list')->nullable()->comment('0 = listed contact - 1 = listed center - 2 = both - 3 = out list - 4 = cancelled');
            $table->text('description')->nullable();
            $table->text('checkin_location')->nullable();
            $table->dateTime('from_time', precision: 0)->nullable();
            $table->text('checkout_location')->nullable();
            $table->dateTime('end_time', precision: 0)->nullable();
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
        Schema::dropIfExists('visits');
    }
};
