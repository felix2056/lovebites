<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->string('productId');
            $table->string('currency');
            $table->decimal('original_price', 8, 2);
            $table->decimal('sale_price', 8, 2);
            $table->string('featured_image')->nullable();
            $table->json('images')->nullable();
            $table->string('url')->nullable();
            $table->integer('totalAvailableQuantity')->nullable();
            $table->text('description')->nullable();
            $table->json('storeInfo')->nullable();
            $table->json('specs')->nullable();
            $table->json('ratings')->nullable();
            $table->boolean('featured')->default(false);
            $table->integer('views')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
