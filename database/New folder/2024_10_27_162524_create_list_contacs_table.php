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
        Schema::create('list_contacs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->string('name_en')->nullable();
            $table->unsignedBigInteger('emplist_id')->nullable();
            $table->foreign('emplist_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emplist_id');
            $table->text('note')->nullable();
            $table->json('contact_id')->nullable();

            $table->json('center_id')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('list_contacs');
    }
};
