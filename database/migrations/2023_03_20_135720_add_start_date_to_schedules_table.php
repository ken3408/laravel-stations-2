<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartDateToSchedulesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('schedules', function (Blueprint $table) {
      $table->date('start_date')->nullable()->default(null)->comment('開始日付');
      $table->date('end_date')->nullable()->default(null)->comment('終了日付');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('schedules', function (Blueprint $table) {
      //
    });
  }
}
