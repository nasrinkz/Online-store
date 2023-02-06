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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('cover')->nullable();
            $table->string('colors')->nullable();
            $table->string('sizes')->nullable();
            $table->text('description')->nullable();
            $table->text('shortDescription')->nullable();
            $table->enum('status',[0,1])->default(1);
            $table->enum('special',[0,1])->default(1);
            $table->enum('header',['no','yes'])->default('no');
            $table->foreignId('brand_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('originalPrice')->nullable();
            $table->string('sellingPrice')->nullable();
            $table->timestamps();
        });
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>';
        DB::table('products')->insert([
            ['title' => 'Shoes1','header'=>'no' , 'cover' => 'images/products/cover/01.jpg','colors'=>'1,2','sizes'=>1,'brand_id'=>1,'category_id'=>4,
                'originalPrice'=>430,'sellingPrice'=>410,'description'=>''],
            ['title' => 'Bag','header'=>'no' , 'cover' => 'images/products/cover/05.jpg','colors'=>'1,2','sizes'=>1,'brand_id'=>1,'category_id'=>4,
                'originalPrice'=>430,'sellingPrice'=>410,'description'=>''],
            ['title' => 'Shoes','header'=>'yes', 'cover' => 'images/products/cover/06.jpg','colors'=>'1,2','sizes'=>1,'brand_id'=>1,'category_id'=>4,
                'originalPrice'=>430,'sellingPrice'=>410,'description'=>$text],
        ]);
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
};
