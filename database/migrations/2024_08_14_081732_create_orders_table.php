<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id');
            $table->date('order_date');
            $table->decimal('total_amount', 10, 2);
            $table->string('order_status');
            $table->string('customer_ip')->default("0.0.0.0"); // Default value for IP
            $table->string('customer_generated_id')->default("adminOrder"); // Default value for generated ID
            $table->timestamps();

            // Foreign key constraint on table_id
            $table->foreign('table_id')
                  ->references('id')
                  ->on('tables')
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
        Schema::dropIfExists('orders');
    }
}
