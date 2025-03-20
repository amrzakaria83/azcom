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
        Schema::create('relative_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')
                    ->references('id')->on('contacts')->onDelete('cascade')->comment('contact_id');
            $table->tinyInteger('relative_status')->default(0)->comment("0 = not_knowen - 1 = wife - 2 = husband - 3 = daughter  - 4 = son - 5 = father - 6 = mather - 7 = grandson - 8 = grandfather");
            $table->text('name_en')->nullable();
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->tinyInteger('gender')->default(0)->comment("0 = male - 1 = female - 2 = other ");
            $table->tinyInteger('marital_status')->default(0)->comment("0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1");
            $table->text('email')->nullable();
            $table->text('website')->nullable();
            $table->text('facebook')->nullable();
            $table->text('socialmedia')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('relative_contacts');
    }
};
