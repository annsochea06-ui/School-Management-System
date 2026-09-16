<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // បិទ Foreign Key Check ជាបណ្ដោះអាសន្ន
        Schema::disableForeignKeyConstraints();

        Schema::create('timetables', function (Blueprint $table) {
            $table->id();

            // កំណត់ Foreign Keys 
            $table->foreignId('school_class_id')->constrained('school_classes')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');

            $table->string('room_name')->nullable();
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });

        // បើក Foreign Key Check វិញ
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};