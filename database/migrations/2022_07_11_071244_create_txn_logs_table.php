<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('txn_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['IN', 'OUT']);
            $table->enum('sub_type', ['from_company', 'from_employee']);
            $table->string('bill_no')->nullable();
            $table->decimal('bill_amount', 10, 2)->nullable();
            $table->string('order_id')->nullable();
            $table->string('remarks', 200)->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employee_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('txn_logs');
    }
};
