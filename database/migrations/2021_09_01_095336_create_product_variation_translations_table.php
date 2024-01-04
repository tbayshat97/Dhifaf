<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pv_id')->comment('product_variation_id')->index('pv_id_foreign')->constrained('product_variations')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['pv_id', 'locale'], 'pv_id_locale_unique');
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
        Schema::dropIfExists('product_variation_translations');
    }
}
