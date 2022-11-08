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
            $table->bigInteger('user_id')->unsigned();
            $table->string('order_number');
            $table->enum('status', ['pending', 'processing', 'completed', 'declined']);
            $table->string('payment_method');
            $table->string('payment_intent_id')->nullable();
            $table->string('payment_intent_status')->nullable();
            $table->string('payment_intent_client_secret')->nullable();
            $table->string('payment_intent_amount')->nullable();
            $table->string('payment_intent_currency')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
