<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            // FK ទៅ users
            $table->foreignId('user_id')->default(1)->constrained()->onDelete('cascade');
            
            // FK ទៅ school_classes
            $table->foreignId('school_class_id')->constrained('school_classes')->onDelete('cascade');
            
            $table->string('student_code')->unique()->index();
            $table->string('profile_image')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            // $table->date('dob')->nullable(); // បើកប្រើវិញដើម្បីការពារ Error Validate dob
            $table->string('phone')->nullable();
            $table->string('parent_phone')->nullable();
            $table->enum('status', ['active', 'suspended', 'graduated'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};