<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesrequests', function (Blueprint $table) {
            $table->increments('sales_request_id');
			$table->string('mall_id');
			$table->string('sales_request_code')->nullable();
			$table->string('qoutation_addressee')->nullable();
			$table->string('requester')->nullable();
			$table->date('date_needed')->nullable();
			$table->string('on_site_survey')->nullable();
			$table->string('comment')->nullable();
			$table->string('project_requirements_files')->nullable();
      $table->string('status')->nullable();
      $table->string('pm_supervisor_id')->nullable();
	  $table->string('pm_assigned_id')->nullable();
      $table->string('pm_approval_status')->nullable();
      $table->string('pm_remarks')->nullable();
	  $table->string('project_title')->nullable();
	  $table->string('category')->nullable();
	  $table->string('revision')->nullable();
    $table->string('proof_of_sending')->nullable();
	  $table->string('po_ntp_files')->nullable();
	  $table->string('proposal_files')->nullable();
    $table->string('bid_summary_files')->nullable();
    $table->string('cer_files')->nullable();
    $table->string('proof_of_cancellation')->nullable();
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
        Schema::dropIfExists('salesrequests');
    }
}
