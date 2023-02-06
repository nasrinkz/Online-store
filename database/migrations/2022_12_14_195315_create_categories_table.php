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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('status',[0,1])->default(1);
            $table->timestamps();
        });
        DB::table('categories')->insert([
            ['title' => 'Smart', 'image' => 'images/categories/iphone.jpg'],
            ['title' => 'Women', 'image' => 'images/categories/jumper.jpg'],
            ['title' => 'Men', 'image' => 'images/categories/tree dasher.jpg'],
            ['title' => 'Shoes', 'image' => 'images/categories/wool-shoe.jpg'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
