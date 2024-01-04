<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCombinationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_combination_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pc_id')->comment('product_combination_id')->index('pc_id_foreign')->constrained('product_combinations')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('combination');
            $table->unique(['pc_id', 'locale'], 'pc_id_locale_unique');
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
        Schema::dropIfExists('product_combination_translations');
    }
}
