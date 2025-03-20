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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
                    ->references('id')->on('type_centers')->onDelete('cascade')->comment('hospital - clinic ..etc');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')
                    ->references('id')->on('areas')->onDelete('cascade')->comment('area_id');
            $table->string('name_en')->nullable();

            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('landline')->nullable();
            $table->string('landline2')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->text('address')->nullable();
            $table->text('map_location')->nullable();
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
        Schema::dropIfExists('centers');
    }
};
