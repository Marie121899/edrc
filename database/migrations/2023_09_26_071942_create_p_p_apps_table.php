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
        Schema::create('p_p_apps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('citizen_id');
            $table->string('applicant_id_copy');
            $table->string('father_birthcertificate');
            $table->string('mother_birthcertificate');
            $table->string('applicant_birthcertificate');
            $table->date('date_to_submit_biometrics');
            $table->enum('status', ['inreview', 'processing', 'completed', 'cancelled'])->default('inreview');
            $table->string('passport_size_photos');
            $table->timestamps();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_p_apps');
    }
};
