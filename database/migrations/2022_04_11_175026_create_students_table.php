<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('DOB')->nullable();
            $table->string('email')->unique();
            $table->string('password')->Hash('123123');
            $table->string('faculty_id')->nullable();
            $table->foreignId('section_id')->nullable();
            $table->string('semesters_id')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('tuitionfee');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
