<?php
/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flower_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('deliveryAdd')->nullable();
            $table->datetime('pdDateTime')->nullable();
            $table->integer('customerID')->unsigned();
            $table->foreign('customerID')->references('id')->on('consumers');
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
        Schema::dropIfExists('flower_orders');
    }
}
