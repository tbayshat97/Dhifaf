<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentMethods;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('cascade');
            $table->foreignId('customer_address_id')->nullable()->constrained('customer_addresses')->onDelete('cascade');
            $table->string('order_number');
            $table->tinyInteger('payment_method')->unsigned()->default(PaymentMethods::CashOnDelivery);
            $table->tinyInteger('status')->unsigned()->default(OrderStatus::Pending);
            $table->boolean('is_finished')->default(false);
            $table->unsignedDecimal('discount', 11, 2)->default(0);
            $table->unsignedDecimal('tax', 11, 2)->default(0);
            $table->unsignedDecimal('sub_total', 11, 2)->default(0);
            $table->unsignedDecimal('total_cost', 11, 2)->default(0);
            $table->unsignedDecimal('delivery_total', 11, 2)->default(3);
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
        Schema::dropIfExists('orders');
    }
}
