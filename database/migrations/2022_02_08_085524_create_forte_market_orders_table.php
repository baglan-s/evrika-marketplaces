<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForteMarketOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forte_market_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('forte_market_order_status_id');
            $table->text('guid');
            $table->boolean('is_sent')->default(false);
            $table->timestamps();

            $table->foreign('forte_market_order_status_id')
                ->references('id')
                ->on('forte_market_order_statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forte_market_orders');
    }
}
