<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiscExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misc_expenditures', function (Blueprint $table) {
            $table->id();
            $table->double('expense_amount')->nullable(); 
            $table->string('description')->nullable();   
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('misc_expenditures');
    }
}
