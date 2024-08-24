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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->string('university')->nullable();
            $table->string('degree')->nullable();
            $table->string('year')->nullable();
            $table->date('dob')->nullable();
            $table->string('personal_description')->nullable();
            $table->string('skills')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('enrollment_type')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
