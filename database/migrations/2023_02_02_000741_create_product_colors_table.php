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
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('color_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('number')->nullable()->comment('موجودی');
            $table->timestamps();
        });
        DB::table('product_colors')->insert([
            ['product_id' => 1, 'color_id' => 1,'number'=>2],
            ['product_id' => 1, 'color_id' => 2,'number'=>3],
            ['product_id' => 2, 'color_id' => 1,'number'=>2],
            ['product_id' => 2, 'color_id' => 2,'number'=>3],
            ['product_id' => 3, 'color_id' => 1,'number'=>2],
            ['product_id' => 3, 'color_id' => 2,'number'=>3],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_colors');
    }
};
