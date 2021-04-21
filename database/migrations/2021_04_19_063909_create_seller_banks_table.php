<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_banks', function (Blueprint $table) {
            $table->increments('seller_account_id');
            $table->bigInteger('seller_id');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_firstname');
            $table->string('account_middlename');
            $table->string('account_lastname');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_banks');
    }
}
