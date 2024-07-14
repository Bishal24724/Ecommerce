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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('picture');
            $table->string('description');
           
            $table->float('price');
            $table->integer('quantity');
          
            $table->unsignedBigInteger('bid');
            $table->unsignedBigInteger('cid');
            $table->unsignedBigInteger('tid');
            $table->integer('vid');

            $table->foreign('bid')->references('id')->on('brands');                                                                                                                                                                   
            $table->foreign('cid')->references('id')->on('categories');
            $table->foreign('tid')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
