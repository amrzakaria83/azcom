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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('empreceved_id');
            $table->foreign('empreceved_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('empreceved_id');
            $table->unsignedBigInteger('type_tool_id')->nullable();
            $table->foreign('type_tool_id')
                    ->references('id')->on('type_tools')->onDelete('cascade')->comment('type_tool_id');
            $table->string('name_en')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('tools');
    }
};
