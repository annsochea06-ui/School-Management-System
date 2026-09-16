<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // បិទ Foreign Key Check ជាបណ្តោះអាសន្ន
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('school_class_id')->nullable()->constrained('school_classes')->onDelete('cascade');
            $table->date('attendance_date');
            $table->enum('status', ['present', 'absent', 'permission'])->default('present');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        // បើក Foreign Key Check មកវិញ
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};