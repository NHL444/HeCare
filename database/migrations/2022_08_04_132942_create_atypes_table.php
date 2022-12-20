<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atypes', function (Blueprint $table) {
            $table->increments('atp_id');
            $table->string('atp_name',100);
            $table->string('atp_slug',100)->index();
            $table->Integer('atp_parent');
            $table->Integer('atp_total')->default(0);
            $table->string('atp_photo');
            $table->string('atp_logo');
            $table->tinyInteger('atp_status')->default(0);
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
        Schema::dropIfExists('atypes');
    }
}
