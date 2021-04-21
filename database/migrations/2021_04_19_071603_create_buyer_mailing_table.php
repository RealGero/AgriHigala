<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerMailingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_mailing', function (Blueprint $table) {
            $table->increments('buyer_mailing_id');
            $table->bigInteger('buyer_id');
            $table->bigInteger('brgy_id');
            $table->string('address');
            $table->string('mobile_number');
            $table->string('email')->nullable();
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
        Schema::dropIfExists('buyer_mailing');
    }
}
