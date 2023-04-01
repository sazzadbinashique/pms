<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id(); 
            $table->string('medicine_name')->nullable();
            $table->integer('product_id')->nullable();   
            $table->string('product_category')->nullable();  
            $table->string('generic_name')->nullable();    
            $table->string('strength')->nullable();      
            $table->double('quantity')->nullable();
            $table->double('stock_out_quantity')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('chalan_invoice_no')->nullable();
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
        Schema::dropIfExists('inventories');
    }
}
