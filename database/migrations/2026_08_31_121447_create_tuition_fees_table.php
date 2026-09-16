<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ១. បិទ Foreign Key Constraints បណ្ដោះអាសន្នដើម្បីកុំឱ្យទាក់ Error ពេលបង្កើត Table
        Schema::disableForeignKeyConstraints();

        Schema::create('tuition_fees', function (Blueprint $table) {
            $table->id();
            
            // ២. បញ្ជាក់ឈ្មោះតារាង 'students' ឱ្យច្បាស់លាស់នៅក្នុង constrained()
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            
            $table->decimal('amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->date('due_date');
            $table->enum('status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->string('invoice_no')->unique();
            $table->timestamps();
        });

        // ៣. បើក Foreign Key Constraints មកវិញ
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('tuition_fees');
    }
};