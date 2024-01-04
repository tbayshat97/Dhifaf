<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            $table->string('locale')->index();
            $table->text('name');
            $table->unique(['size_id', 'locale']);
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
        Schema::dropIfExists('size_translations');
    }
}
