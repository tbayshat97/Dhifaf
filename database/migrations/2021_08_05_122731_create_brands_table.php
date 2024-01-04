<?php

use App\Enums\BrandType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_brand_id')->nullable()->default(null)->constrained('brands')->onDelete('cascade');
            $table->string('code')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('account_verified_at')->nullable();
            $table->text('image')->nullable();
            $table->text('header')->nullable()->default(null);
            $table->rememberToken();
            $table->tinyInteger('status')->unsigned()->default(BrandType::Normal);
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(1);
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
        Schema::dropIfExists('brands');
    }
}
