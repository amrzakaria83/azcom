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
        Schema::create('vacationemps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_add');
            $table->unsignedBigInteger('emp_vacation');
            $table->foreign('emp_vacation')
                    ->references('id')->on('employees')->onDelete('cascade')->comment('emp_vacation');
            $table->timestamp('vactionfrom')->nullable();
            $table->timestamp('vactionto')->nullable();
            $table->timestamp('vactionfrommanger')->nullable();
            $table->timestamp('vactiontomanger')->nullable();
            $table->tinyInteger('vacationrequesttype')->default(0)->comment("0 =  general leave - 1 = sick leave ");
            $table->tinyInteger('vacationrequest')->default(0)->comment("0 = without salary - 1 = 50%salary - 2 = fullsalary ");
            $table->tinyInteger('typevacation')->default(0)->comment("0 = without salary - 1 = 50%salary - 2 = fullsalary ");
            $table->tinyInteger('statusmangeraprove')->default(0)->comment("0 = waitting - 1 = approved - 2 = rejected - 3 = delayed ");
            $table->tinyInteger('status')->default(0)->comment("0 = active - 1 = not active ");
            $table->text('noterequest')->nullable();
            $table->text('notemanger')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacationemps');
    }
};
