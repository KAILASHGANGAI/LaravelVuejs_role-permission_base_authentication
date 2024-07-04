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
        Schema::create('teacher_leave_management', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('leave_type');
            $table->integer('leave_days');
            $table->string('reason');
            $table->string('status')->default('Pending');
            $table->string('approved_by')->nullable();
            $table->string('decline_by')->nullable();
            $table->string('decline_reason')->nullable();
            $table->string('approved_by_name')->nullable();
            $table->string('decline_by_name')->nullable();
            $table->string('decline_reason_name')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_leave_management');
    }
};
