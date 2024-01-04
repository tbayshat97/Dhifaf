<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteSliderTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_slider_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_slider_id')->constrained('website_sliders')->onDelete('cascade');
            $table->string('title');
            $table->string('content')->nullable();
            $table->string('action')->nullable();
            $table->string('locale')->index();
            $table->unique(['website_slider_id', 'locale']);
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
        Schema::dropIfExists('website_slider_translations');
    }
}
