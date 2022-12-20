<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('atl_title',100);
            $table->string('atl_slug',100)->index();
            $table->integer('atl_type')->unsigned(); 
            $table->string('atl_topic',100);
            $table->string('atl_photo');
            $table->text('atl_descript');
            $table->longText('atl_content');
            $table->foreign('atl_type')->references('atp_id')->on('atypes')->onDelete('cascade');
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
        Schema::dropIfExists('articles');
        // $table->dropForeign('lists_user_id_foreign');
        // $table->dropIndex('lists_user_id_index');
        // $table->dropColumn('user_id');
    }
}
