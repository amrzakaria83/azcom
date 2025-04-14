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
        Schema::table('hierarchy_emps', function (Blueprint $table) {
            $table->tinyInteger('status_prod')->default(0)->comment('0 = prod active - 1 = prod notactive');
            $table->json('prod')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hierarchy_emps', function (Blueprint $table) {
            //
        });
    }
};
