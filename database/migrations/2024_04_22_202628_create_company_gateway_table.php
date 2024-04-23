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
        Schema::create('company_gateway', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_company')->references('id_company')->on('company')->onDelete('cascade');
            $table->string('name_gateway');
            $table->string('public_key');
            $table->string('live_api_key');
            $table->string('recipient_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_gateway');
    }
};
