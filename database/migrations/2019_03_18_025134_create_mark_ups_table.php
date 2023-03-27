<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_ups', function (Blueprint $table) {
            $table->increments('mark_up_id');
            $table->string('sales_request_id');
            $table->string('markup_uploader')->nullable();
            $table->string('mark_up_file')->nullable();
            $table->string('pnl_file')->nullable();
            $table->string('project_size')->nullable();
            $table->string('mark_up_remarks')->nullable();
            $table->string('pm_supervisor_id')->nullable();
            $table->string('pm_remarks_yes')->nullable();
            $table->string('pm_remarks')->nullable();
            $table->string('pm_status')->nullable();
            $table->string('rev_head_id')->nullable();
            $table->string('rev_head_remarks')->nullable();
            $table->string('rev_head_status')->nullable();
            $table->string('finance_head_id')->nullable();
            $table->string('finance_head_remarks')->nullable();
            $table->string('finance_head_status')->nullable();
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
        Schema::dropIfExists('mark_ups');
    }
}
