<?php

use App\Enums\DiscountType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->unsignedDecimal('value', 6, 2)->default(0);
            $table->integer('ec_per_coupon')->nullable()->default(null);
            $table->integer('ec_per_customer')->nullable()->default(null);
            $table->boolean('is_active')->default(true);
            $table->boolean('free_shipping')->default(true);
            $table->tinyInteger('type')->unsigned()->default(DiscountType::Fixed);
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
        Schema::dropIfExists('coupons');
    }
}
