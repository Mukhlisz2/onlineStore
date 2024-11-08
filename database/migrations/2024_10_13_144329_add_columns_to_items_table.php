<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('items', function (Blueprint $table) {
        $table->integer('quantity');
        $table->decimal('price', 10, 2);
        $table->unsignedBigInteger('product_id');
        $table->unsignedBigInteger('order_id');

        // Jika ada foreign key:
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('items', function (Blueprint $table) {
        $table->dropColumn(['quantity', 'price', 'product_id', 'order_id']);
    });
}

};
