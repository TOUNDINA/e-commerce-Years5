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
            $table->string('name');
            $table->double('pricing');
            $table->double('discount')->nullable();
            $table->string('tags')->nullable();
            $table->string('color')->nullable();
            $table->integer('rating')->default(0);
            $table->integer('purchased_num')->default(0);
            $table->string('size')->nullable();
            $table->string('brand')->nullable();
            $table->string('image');
            $table->string('style')->nullable();
            $table->string('model')->nullable();
            $table->string('shipping')->nullable();
            $table->string('description');
            $table->timestamps();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            
            // $table->bigInteger('category_id')->unsigned()->nullable();
            // $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();

            // $table->bigInteger('supplier_id')->unsigned();
            // $table->foreign('supplier_id')->references('id')->on('suppliers');
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
