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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->string('license_number')->unique();
            $table->date('issue_date');
            $table->integer('period'); // 1, 3, 6, or 12 months
            $table->date('expiration_date')->nullable();
            $table->date('renewal_date')->nullable();
            $table->enum('status', ['active', 'expired', 'pending_renewal', 'cancel']);
            $table->text('description')->nullable(); // Additional information or notes
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('businesses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
