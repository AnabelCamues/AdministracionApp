<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on("users")->onDelete('cascade');
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on("organizations")->onDelete('cascade');
            $table->string('order_number');
            $table->string('direction');
            $table->text('observation');
            $table->string('latitude');
            $table->string('longitude');
            $table->decimal('total',8,2);
            $table->decimal('delivery_cost',8,2);
            $table->decimal('subtotal',8,2);
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
