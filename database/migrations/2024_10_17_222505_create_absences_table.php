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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('absence_date');
            $table->string('reason');
            $table->time('start_time')->nullable();      // Jam mulai
            $table->time('end_time')->nullable();        // Jam selesai
            $table->integer('overtime_duration')->nullable();
            $table->boolean('is_paid')->default(false); // Kolom untuk status gaji, default belum digaji (false)
            $table->boolean('payment_info')->default(false); // Menambah field "payment_info"
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
