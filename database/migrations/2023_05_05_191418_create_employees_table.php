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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->enum('is_active', ['0', '1', '2', '3'])->default('1')->comment('0 => not active, 1 => active, 2 => suspended , 3 => terminated');
            $table->tinyInteger('role_id'); 
            $table->tinyInteger('type'); 
            $table->string('national_id')->nullable(); 
            $table->date('birth_date')->default(now());
            $table->date('work_date')->default(now());
            $table->text('address1'); 
            $table->text('address2')->nullable();
            $table->text('address3')->nullable();
            $table->text('job_title')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->tinyInteger('gender')->default(0)->comment('0 = male, 1 = female');
            $table->tinyInteger('method_for_payment')->default(0)->comment('0 = cash, 1 = bank_transefer');
            $table->text('acc_bank_no')->nullable();
            $table->text('note')->nullable();
            $table->text('token')->nullable();
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
