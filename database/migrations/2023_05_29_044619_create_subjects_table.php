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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('semester_id');
            $table->string('faculty_id');
            $table->string('subjects');
            $table->string('subjects_code')->nullable();
            $table->integer('fullmarks');
            $table->integer('passmarks');
            $table->integer('practical_fullmarks')->nullable();
            $table->integer('practical_passmarks')->nullable();
            $table->integer('creadit_hrs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
