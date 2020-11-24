<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PropertyAnalytics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_analytics', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('property_id')->unsigned();
            $table->integer('analytic_type_id')->unsigned();
            $table->text('value')->nullable();
        });


        Schema::table('property_analytics', function (Blueprint $table) {
            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('analytic_type_id')->references('id')->on('analytic_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('property_analytics');
    }
}
