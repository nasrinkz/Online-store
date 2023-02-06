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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string("image")->nullable();
            $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        DB::table('product_images')->insert([
            ['product_id' => 1, 'image' => 'images/products/images/1-big-mage.jpg'],
            ['product_id' => 2, 'image' => 'images/products/images/2.jpg'],
            ['product_id' => 3, 'image' => 'images/products/images/4-big-image.jpg']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
};
