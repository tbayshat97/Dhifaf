<?php

use App\Enums\AgeGroup;
use App\Enums\ProductGender;
use App\Enums\ProductStatus;
use App\Enums\StockStatus;
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
            $table->string('code')->nullable();
            $table->string('barcode')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->json('categories')->nullable();
            $table->json('sub_categories')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('sale_price', 15, 2)->nullable();
            $table->dateTime('sale_price_from')->nullable();
            $table->dateTime('sale_price_to')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('rate')->default(0);
            $table->tinyInteger('stock_status')->nullable()->unsigned()->default(StockStatus::InStock);
            $table->tinyInteger('status')->unsigned()->default(ProductStatus::Draft);
            $table->tinyInteger('gender')->unsigned()->default(ProductGender::All);
            $table->tinyInteger('age_group')->unsigned()->default(AgeGroup::All);
            $table->boolean('is_featured')->default(false);
            $table->boolean('track_inventory')->default(false);
            $table->boolean('is_variant')->default(false);
            $table->boolean('best_sellers')->default(false);
            $table->boolean('special_offer')->default(false);
            $table->boolean('new_arrival')->default(false);
            $table->boolean('search_appearance')->default(false);
            $table->dateTime('new_from')->nullable();
            $table->dateTime('new_to')->nullable();
            $table->foreignId('size_id')->nullable()->constrained('sizes')->onDelete('set null');
            $table->foreignId('color_id')->nullable()->constrained('colors')->onDelete('set null');
            $table->longText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->json('tags')->nullable();
            $table->json('image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('switcher')->nullable();
            $table->timestamps();
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
