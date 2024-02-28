<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable()->unique();
            $table->string('slug')->unique();
            $table->enum('sex', ['male', 'female', 'other']);
            $table->date('birth_date');
            $table->string('token');
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
