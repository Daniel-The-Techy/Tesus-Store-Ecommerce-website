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
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->constrained('customers')->onDelete('cascade');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('Email');
            $table->string('company');
            $table->string('Address_1');
            $table->string('Address_2');
            $table->string('city');
            $table->integer('Postal_Code');
            $table->string('country');
            $table->string('State');
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
        Schema::dropIfExists('orderdetails');
    }
};
