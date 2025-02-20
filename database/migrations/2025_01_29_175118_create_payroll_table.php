<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->string('month_year');
            $table->decimal('total_salary', 10, 2);
            $table->decimal('deductions', 10, 2);
            $table->decimal('overtime_amount', 10, 2);
            $table->decimal('final_salary', 10, 2);
            $table->dateTime('generated_date');
            $table->decimal('total_tips', 10, 2);
            $table->timestamps();
        
            $table->foreign('staff_id')
                ->references('id')
                ->on('staff')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll');
    }
}
