<?php
/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderID')->unsigned();
            $table->foreign('orderID')->references('id')->on('flower_orders');
            $table->datetime('actual_date');
            $table->datetime('actual_time');
            $table->integer('staffID')->unsigned();
            $table->foreign('staffID')->references('id')->on('staff');
            $table->string('status');
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
        Schema::dropIfExists('order_managements');
    }
}
