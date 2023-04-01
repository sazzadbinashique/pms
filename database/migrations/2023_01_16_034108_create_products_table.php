<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->nullable(); 
            $table->string('manufacturer_company')->nullable();  
            $table->string('product_category')->nullable();  
            $table->string('product_group')->nullable();
            $table->string('medicine_name')->nullable();   
            $table->string('generic_name')->nullable();    
            $table->string('strength')->nullable(); 
            $table->string('base_name')->nullable();
            //$table->double('price')->nullable();
            //$table->double('sales_price')->nullable();
            //$table->date('start_date')->nullable();
            //$table->date('end_date')->nullable();
            $table->string('use_for')->nullable();
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
        Schema::dropIfExists('products');
    }
}
