<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnMoviesColumn extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('movies', function (Blueprint $table) {
      $table->dropColumn('video_id');
      $table->dropColumn('title');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('movies', function (Blueprint $table) {
      $table->text('title');
    });
  }
}
