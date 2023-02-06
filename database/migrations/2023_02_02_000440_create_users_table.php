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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('FullName')->nullable();
            $table->string('email')->unique();
            $table->enum('status',[0,1])->default(1);
            $table->string('password')->nullable();
            $table->foreignId('user_group_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            ['id'=>1,'FullName' => 'Name Family','email'=>'admin@gmail.com','status'=>'1','user_group_id'=>1,'password'=>Hash::make('admin')],
            ['id'=>2,'FullName' => 'Name Family','email'=>'customer@gmail.com','status'=>'1','user_group_id'=>2,'password'=>Hash::make('customer')],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
