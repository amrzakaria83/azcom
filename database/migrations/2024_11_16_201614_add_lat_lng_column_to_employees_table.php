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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('social_insurance_no')->nullable();
            $table->string('medical_insurance_no')->nullable();
            $table->string('salary')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('department')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->foreign('level_id')
                    ->references('id')->on('level_sequences')->onDelete('cascade')->comment('level_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
