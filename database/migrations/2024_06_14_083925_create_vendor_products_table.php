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
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();
         
            $table->string('title');
            $table->float('price');
            $table->integer('quantity');
            $table->string('picture');
            $table->string('description');
            $table->string('category');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_products');
    }
};
