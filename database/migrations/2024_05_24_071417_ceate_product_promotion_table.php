<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_promotion', function (Blueprint $table) {
            $table->id();
            $table->decimal('discount_price', 8, 2);
            $table->timestamps();

            // Foreign keys
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->bigInteger('promotion_id')->unsigned();
            $table->foreign('promotion_id')->references('id')->on('promotions');

        });
    }

    public function down()
    {
        Schema::dropIfExists('product_promotion');
    }
};
