<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandAboutTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_about_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_about_id')->constrained('brand_abouts')->onDelete('cascade');
            $table->string('locale')->index();
            $table->text('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->unique(['brand_about_id', 'locale']);
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
        Schema::dropIfExists('brand_about_translations');
    }
}
