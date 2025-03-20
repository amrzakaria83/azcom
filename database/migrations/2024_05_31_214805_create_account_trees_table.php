<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('account_trees', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('emp_id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('type')->default(0)->comment('0 = sub have parent_id - 1 = major advance_payment');
            $table->tinyInteger('type_account')->default(0)->comment('0 = debite - 1 = credite');
            $table->bigInteger('value')->default(0); 
            $table->bigInteger('targete')->default(0); 
            $table->bigInteger('parent_targete')->default(0); 
            $table->bigInteger('parent_value')->nullable()->comment('for clossing and sub item'); 
            $table->tinyInteger('status')->default(0)->comment('0 = active - 1 = not active');
            $table->string('note')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Define foreign key constraint (if applicable)
            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('account_trees');
    }
};