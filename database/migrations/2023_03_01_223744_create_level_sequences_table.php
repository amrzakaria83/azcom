<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('level_sequences', function (Blueprint $table) {
            $table->id();
            
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->Integer('parent_id')->nullable();
            $table->tinyInteger('type')->default(0)->comment("0 = sub have parent_id - 1 =  major ");
            $table->text('note')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = active - 1 = notactive');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('level_sequences')->insert([
            [
                'id' => 1,
                'name_ar' => 'المستوى الاعلى',
                'name_en' => 'Hieghst Level',
                'parent_id' => NULL,
                'type' => 1,
                'status' => 0,
                'note' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-06-04 09:25:42',
                'updated_at' => '2024-06-04 09:25:42'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_sequences');
    }
};
