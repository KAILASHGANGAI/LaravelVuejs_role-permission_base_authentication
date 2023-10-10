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
        Schema::create('librearies', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('publication');
            $table->string('faculty')->nullable();
            $table->string('semester')->nullable();
            $table->integer('total')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('librearies');
    }
};
