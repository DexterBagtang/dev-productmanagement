<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiddingdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biddingdetails', function (Blueprint $table) {
            $table->increments('id');
			$table->string('bidding_id');
			$table->string('contractor_name')->nullable();
			$table->string('total_cost')->nullable();
			$table->string('bid_trade')->nullable();
      $table->string('bid_status')->nullable();
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
        Schema::dropIfExists('biddingdetails');
    }
}
