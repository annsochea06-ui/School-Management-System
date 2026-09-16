<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ១. បិទ Foreign Key Check ជាបណ្ដោះអាសន្ន
        Schema::disableForeignKeyConstraints();

        Schema::create('teacher_attendances', function (Blueprint $table) {
            $table->id();
            
            // ២. កំណត់ Column ជា unsignedBigInteger ជាមុនសិន
            $table->unsignedBigInteger('teacher_id');
            $table->date('attendance_date');
            $table->enum('status', ['present', 'join', 'absent', 'late', 'permission'])->default('join');
            $table->unsignedBigInteger('school_class_id')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            // ៣. បង្កើត Foreign Keys ដោយផ្ទាល់
            $table->foreign('teacher_id')
                  ->references('id')
                  ->on('teachers')
                  ->onDelete('cascade');

            $table->foreign('school_class_id')
                  ->references('id')
                  ->on('school_classes')
                  ->onDelete('set null');
        });

        // ៤. បើក Foreign Key Check វិញ
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_attendances');
    }
};