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
        Schema::create('nonresidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string("lname");
            $table->string("surname");
            $table->date("dob");
            $table->string('profile');
            $table->string("passportnumber");
            $table->string("phone");
            $table->string("address");
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string("city");
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nonresidents');
    }
};
