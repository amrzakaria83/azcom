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
        Schema::create('event_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')
                    ->references('id')->on('events')->onDelete('cascade')->comment('event_id');
            $table->dateTime('from_time', precision: 0)->nullable();
            $table->dateTime('to_time', precision: 0)->nullable();
            $table->tinyInteger('type_event_content')->default(4)->comment('0 = schedule - 1 = logistics - 2 = point discussion - 3 = recommended activities - 4 = other');
            $table->string('name_en')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('event_contents');
    }
};
