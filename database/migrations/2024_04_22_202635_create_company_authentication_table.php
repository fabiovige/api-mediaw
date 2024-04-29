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
        Schema::create('company_authentication', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_company')->references('id_company')->on('company')->onDelete('cascade');
            $table->string('token_api_service', 512)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_authentication');
    }
};
