<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invent_details', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_name')->nullable();
            $table->integer('product_id')->nullable();        
            $table->double('quantity')->nullable();
            $table->string('transction_type')->nullable();
            $table->double('add_remove_qty')->nullable();
            $table->double('total_qty')->nullable();
            $table->date('trnsc_time')->nullable();
            $table->double('purchase_price_rate')->nullable();
            $table->double('sales_price_rate')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('base_name')->nullable();
            $table->string('chalan_invoice_no')->nullable();
            $table->string('description')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('inventry_tbl_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->date('trigger_time')->nullable();
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
        Schema::dropIfExists('invent_details');
    }
}
