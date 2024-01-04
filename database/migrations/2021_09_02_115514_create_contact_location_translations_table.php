<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactLocationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_location_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_location_id')->constrained('contact_locations')->onDelete('cascade');
            $table->string('locale')->index();
            $table->text('country')->nullable();
            $table->text('street')->nullable();
            $table->text('area')->nullable();
            $table->text('city')->nullable();
            $table->unique(['contact_location_id', 'locale']);
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
        Schema::dropIfExists('contact_location_translations');
    }
}
