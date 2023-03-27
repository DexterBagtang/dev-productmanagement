<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biddings', function (Blueprint $table) {
            $table->increments('bidding_id');
            $table->string('sales_request_id');
			$table->string('purchasing_uploader')->nullable();
			$table->string('bid_file')->nullable();
			$table->string('pm_supervisor_id')->nullable();
			$table->string('pm_remarks')->nullable();
      $table->string('remarks_id')->nullable();
      $table->string('pm_remarks_yes')->nullable();
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
        Schema::dropIfExists('biddings');
    }
}
