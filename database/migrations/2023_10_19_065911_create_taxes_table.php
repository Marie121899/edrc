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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->enum('tax_type', ['income', 'property', 'business', 'sales', 'excise', 'value_added', 'estate', 'gift', 'import', 'fuel', 'other']);
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->enum('payment_status', ['paid', 'unpaid']);
            $table->integer('tax_year');
            $table->unsignedBigInteger('business_id')->nullable();
            $table->unsignedBigInteger('citizen_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->foreign('citizen_id')->references('id')->on('citizens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
