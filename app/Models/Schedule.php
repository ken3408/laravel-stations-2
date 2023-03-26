<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  use HasFactory;
  protected $table = 'schedules';

  protected $dates = [
    'start_time',
    'end_time',
    'start_date',
    'end_date',

  ];
  protected $fillable = [
    'movie_id',
    'start_time',
    'end_time',
    'start_date',
    'end_date',
  ];
  //リレーション先（従）
  public function movie()
  {
    return $this->belongsTo('App\Models\Movie');
  }
}
