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
        Schema::create('hierarchy_emps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('emphier_id')->unique();
            $table->foreign('emphier_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emphier_id');
            $table->tinyInteger('type_hierarchy')->default(0)->comment("0 = main - 1 = middle - 2 = end hierarchy");
            $table->string('parent_id')->nullable();
            $table->json('above_hierarchy')->nullable();
            // $table->json('bellow_hierarchy')->nullable();
            $table->tinyInteger('status_area')->default(0)->comment('0 = area active - 1 = area notactive');
            $table->json('area')->nullable();
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
        Schema::dropIfExists('hierarchy_emps');
    }
};
