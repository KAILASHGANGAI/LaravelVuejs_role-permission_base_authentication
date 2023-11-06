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
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('faculty_id');
            $table->foreignId('semesters_id');
            $table->foreignId('section_id');
            $table->string('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('faculty_id');
            $table->foreignId('semesters_id');
            $table->foreignId('section_id')->nullable();
            $table->date('date');
        });
    }
};
