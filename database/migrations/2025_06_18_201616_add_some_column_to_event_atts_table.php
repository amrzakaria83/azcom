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
        Schema::table('event_atts', function (Blueprint $table) {
            $table->string('lat_checkin')->nullable();
            $table->string('lng_checkin')->nullable();
            $table->string('lat_checkout')->nullable();
            $table->string('lng_checkout')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_atts', function (Blueprint $table) {
            //
        });
    }
};
