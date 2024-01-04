<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationItemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_item_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pvi_id')->comment('product_variation_item_id')->index('pvi_id_foreign')->constrained('product_variation_items')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['pvi_id', 'locale'], 'pvi_id_locale_unique');
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
        Schema::dropIfExists('product_variation_item_translations');
    }
}
