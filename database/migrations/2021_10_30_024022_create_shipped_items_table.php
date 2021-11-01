<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipped_items', function (Blueprint $table) {
            $table->id();
            $table->float('weight');
            $table->float('dimension');
            $table->float('insurance_amt');
            $table->string('destination'); 
            $table->date('final_delivery_date');
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
        Schema::dropIfExists('shipped_items');
    }
}
