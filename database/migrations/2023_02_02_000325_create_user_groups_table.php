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
        Schema::create('user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
            $table->enum('status',[0,1])->default(1);
            $table->text('description')->nullable();
            $table->timestamps();
        });
        DB::table('user_groups')->insert([
            ['id'=>1,'role' => 'Admin','description'=>'Store admin'],
            ['id'=>2,'role' => 'Customer','description'=>'Store customers'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_groups');
    }
};
