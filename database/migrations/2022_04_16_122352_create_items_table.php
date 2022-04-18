<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_code',10);
            $table->string('title',50);
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->text('description');
            $table->enum('status',['accepted','pending','decline']);
            $table->string('img_url',50);
            $table->bigInteger('taken_by')->unsigned();
            $table->dateTime('taken_at');

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('taken_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('items');
    }
}
