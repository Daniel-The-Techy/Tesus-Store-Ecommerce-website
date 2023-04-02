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
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastName')->after('name');
            $table->string('company')->nullable();
            $table->string('Address_1')->nullable();
            $table->string('Address_2')->nullable();
            $table->string('city')->nullable();
            $table->integer('Postal_Code')->nullable();
            $table->string('country')->nullable();
            $table->string('State')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
