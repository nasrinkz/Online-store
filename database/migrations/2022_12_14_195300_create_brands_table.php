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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('status',[0,1])->default(1);
            $table->timestamps();
        });
        DB::table('brands')->insert([
            ['title' => 'brand1', 'image' => 'images/brands/01.png'],
            ['title' => 'brand2', 'image' => 'images/brands/02.png'],
            ['title' => 'brand3', 'image' => 'images/brands/03.png'],
            ['title' => 'brand4', 'image' => 'images/brands/04.png'],
            ['title' => 'brand5', 'image' => 'images/brands/03.png'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
};
