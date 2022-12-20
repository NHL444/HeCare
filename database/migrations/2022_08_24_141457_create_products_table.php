<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->string('pro_name',100);
            $table->string('pro_slug',100)->index();
            $table->integer('pro_price');
            $table->integer('pro_cate')->unsigned();
            $table->integer('pro_type')->unsigned();
            $table->integer('pro_brand')->unsigned();
            $table->string('pro_origin',100);
            $table->string('pro_image');
            $table->text('pro_descript');
            $table->longText('pro_content');
            $table->tinyInteger('pro_status')->default(0);
            $table->tinyInteger('pro_special')->default(0);
            $table->foreign('pro_cate')->references('cate_id')->on('categories')->onDelete('cascade');
            $table->foreign('pro_type')->references('tp_id')->on('types');
            $table->foreign('pro_brand')->references('br_id')->on('brands');
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
        Schema::dropIfExists('products');
    }
}
