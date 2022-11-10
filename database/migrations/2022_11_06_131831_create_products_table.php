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
            $table->bigInteger('category_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->text('details')->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->json('tech')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('featured_image')->nullable();
            $table->json('images')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('in_stock')->default(true);
            $table->integer('views')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
