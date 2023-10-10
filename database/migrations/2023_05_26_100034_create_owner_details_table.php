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
        Schema::create('owner_details', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->integer('pan_number')->nullable();
            $table->boolean('status')->default(0);
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_details');
    }
};
