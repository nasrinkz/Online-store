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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('position')->nullable();
            $table->text('description')->nullable();
            $table->enum('status',[0,1])->default(1);
            $table->timestamps();
        });
        DB::table('banners')->insert([
            ['title' => 'banner', 'image' => 'images/banners/photo_57872287296914543000.jpeg','position'=>'middle'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
