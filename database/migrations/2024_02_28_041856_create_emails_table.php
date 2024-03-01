<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('email')->unique();
            $table->uuid('emailable_uuid')->nullable();
            $table->string('emailable_type')->nullable();
            $table->boolean('is_main')->default(false);
            $table->boolean('is_validated')->default(false);
            $table->index(['is_main', 'emailable_uuid', 'emailable_type']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
