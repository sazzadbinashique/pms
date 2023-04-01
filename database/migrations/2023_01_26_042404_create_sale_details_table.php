<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_name')->nullable();  
            $table->string('product_id')->nullable(); 
            $table->string('sales_id')->nullable();   
            $table->double('quantity')->nullable();
            $table->double('purchase_price')->nullable();
            $table->double('sales_price')->nullable();
            $table->double('discount_amount')->nullable();
            $table->double('sales_amount')->nullable();
            $table->double('discount')->nullable();
            $table->string('base_name')->nullable();
            $table->string('remarks')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('sale_details');
    }
}
