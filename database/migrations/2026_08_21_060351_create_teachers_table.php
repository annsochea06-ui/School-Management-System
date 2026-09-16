<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // បិទការពិនិត្យ Foreign Key ជាបណ្ដោះអាសន្ន
        Schema::disableForeignKeyConstraints();

        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            
            // កំណត់ Foreign Key
            $table->foreignId('school_class_id')->nullable()->constrained('school_classes')->onDelete('cascade');
            
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('profile_image')->nullable();
            $table->timestamps();
        });

        // បើកការពិនិត្យ Foreign Key វិញ
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('teachers');
        Schema::enableForeignKeyConstraints();
    }
};