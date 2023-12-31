<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_FrKey');
            $table->unsignedBigInteger('Post_id_FrKey');
            $table->timestamps();
    
            $table->foreign('user_id_FrKey')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Post_id_FrKey')->references('Post_Id')->on('posts')->onDelete('cascade');
        });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
