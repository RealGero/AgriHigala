<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->bigInteger('order_id');
            $table->bigInteger('fee_id');
            $table->double('payment_order',8,2);
            $table->double('payment_total',8,2);
            $table->string('payment_image')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->enum('payment_method',['cod','online']);
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
        Schema::dropIfExists('payments');
    }
}
