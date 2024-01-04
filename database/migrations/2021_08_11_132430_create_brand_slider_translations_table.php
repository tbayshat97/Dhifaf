<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandSliderTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_slider_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_slider_id')->constrained('brand_sliders')->onDelete('cascade');
            $table->string('content')->nullable();
            $table->string('title')->nullable();
            $table->text('btn_text')->nullable();
            $table->string('locale')->index();
            $table->unique(['brand_slider_id', 'locale']);
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
        Schema::dropIfExists('brand_slider_translations');
    }
}
