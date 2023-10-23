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
        Schema::create('nonresident_visas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nonresident_id');
            $table->enum('type_of_visa', ['tourist', 'work', 'student', 'other']);
            $table->enum('visa_category', ['short-term', 'long-term', 'other']);
            $table->enum('status', ['approved', 'canceled', 'processing'])->default('processing');
            $table->date('visa_start_date');
            $table->date('visa_end_date');
            $table->string('purpose_of_travel');
            $table->text('travel_itinerary')->nullable();
            $table->text('sponsor_information')->nullable();
            $table->foreign('nonresident_id')->references('id')->on('nonresidents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nonresident_visas');
    }
};
