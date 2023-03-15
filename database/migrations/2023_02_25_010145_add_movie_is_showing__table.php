<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMovieIsShowingTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('movies', function (Blueprint $table) {
      $table->integer('published_year');
      $table->tinyInteger('is_showing')->default(false);
      $table->text('description');
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
      //
    });
  }
}
