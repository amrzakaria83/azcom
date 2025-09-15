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
        Schema::table('plan_visits', function (Blueprint $table) {
            $table->tinyInteger('status_requ')->nullable()->comment("0 = request - 1 = approved - 2 = cancell - 3 = under visit - 4 = visit done ");
            $table->unsignedBigInteger('emp_id_director')->nullable();
            $table->foreign('emp_id_director')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_id_director');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_visits', function (Blueprint $table) {
            //
        });
    }
};
