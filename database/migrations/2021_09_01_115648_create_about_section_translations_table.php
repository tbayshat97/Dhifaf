<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutSectionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_section_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_section_id')->constrained('about_sections')->onDelete('cascade');
            $table->string('locale')->index();
            $table->json('data');
            $table->unique(['about_section_id', 'locale']);
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
        Schema::dropIfExists('about_section_translations');
    }
}
