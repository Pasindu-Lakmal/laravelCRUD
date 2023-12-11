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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('Post_Id'); // Change from 'id('Post_Id')' to just 'id()' for auto-incrementing primary key
            $table->string ('Editor_Id');
            $table->string('Title');
            $table->text('Description');
            $table->timestamp('Expire_Date');
            $table->unsignedInteger('likes_count')->default(0);                
            $table->string('media_path')->nullable();
            $table->string('Approval_Letter')->nullable();
            $table->string('Society_Id')->nullable();
            $table->string('Dep_Id')->nullable();
            $table->string('Faculty_Id')->nullable();    
            $table->timestamps(); // or remove the default value
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
