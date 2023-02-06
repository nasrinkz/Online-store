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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('number')->nullable();
            $table->timestamps();
        });
        DB::table('product_sizes')->insert([
            ['product_id' => 1, 'size_id' => 1,'number'=>5],
            ['product_id' => 2, 'size_id' => 1,'number'=>5],
            ['product_id' => 3, 'size_id' => 1,'number'=>5],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sizes');
    }
};
