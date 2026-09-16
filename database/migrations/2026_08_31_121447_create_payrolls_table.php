<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('bonus', 10, 2)->default(0.00);
            $table->decimal('deduction', 10, 2)->default(0.00);
            $table->decimal('net_salary', 10, 2);
            $table->string('month_year');
            $table->enum('status', ['PAID', 'UNPAID'])->default('unpaid'); // Set Default ជា UNPAID
            $table->string('payment_method')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
