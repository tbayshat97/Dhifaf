<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionBannerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('division_banner_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_banner_id')->constrained('division_banners')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['division_banner_id', 'locale']);
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
        Schema::dropIfExists('division_banner_translations');
    }
}
