<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordetails', function (Blueprint $table) {
            $table->increments('odl_id');
            $table->integer('odl_order');
            $table->integer('odl_pro');
            $table->string('odl_proname');
            $table->string('odl_price');
            $table->integer('odl_qty');
            $table->string('odl_date');
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
        Schema::dropIfExists('ordetails');
    }
}
