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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('social_id')->nullable();
            $table->foreign('social_id')
                    ->references('id')->on('social_styls')->onDelete('cascade')->comment('social_id');
            $table->unsignedBigInteger('contractdr_id')->nullable();
            $table->foreign('contractdr_id')
                    ->references('id')->on('contract_drs')->onDelete('cascade')->comment('contractdr_id');
            $table->unsignedBigInteger('typecont_id')->nullable();
            $table->foreign('typecont_id')
                    ->references('id')->on('type_contacts')->onDelete('cascade')->comment('typecont_id');
            $table->text('name_en');
            $table->text('phone')->nullable();
            $table->text('phone2')->nullable();
            $table->text('landline')->nullable();
            $table->text('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->tinyInteger('gender')->default(0)->comment("0 = male - 1 = female - 2 = other ");
            $table->tinyInteger('marital_status')->default(0)->comment("0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1");
            $table->text('email')->nullable();
            $table->text('website')->nullable();
            $table->text('facebook')->nullable();
            $table->text('socialmedia')->nullable()->comment('other facebook');
            $table->text('note')->nullable();
            $table->json('speciality_id')->nullable();
            $table->json('preferd_gift_brand')->nullable();
            $table->text('university_degree')->nullable();
            $table->text('scientific_degree')->nullable();
            $table->text('preferd_readding')->nullable();
            $table->text('preferd_gift')->nullable();
            $table->text('preferd_service')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
