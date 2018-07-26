<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password');
            $table->string('custName');
            $table->string('custIC');
            $table->string('custGender');
            $table->string('custDob');
            $table->string('address');
            $table->string('email');
            $table->string('ContactNo');
            $table->string('companyName')->nullable();
            $table->double('creditLimit')->nullable();
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
        Schema::dropIfExists('consumers');
    }
}
