<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
  use HasFactory;
  protected $table = 'movies';

  public function genre()
  {
    return $this->belongsTo(Genre::class);
  }
  //リレーション元（主）
  public function schedules()
  {
    return $this->hasMany('App\Models\Schedule');
  }
  protected $fillable = [
    'title',
    'image_url',
    'published_year',
    'description',
    'is_showing',
    'genre_id'
  ];
  /**
   * 部分検索機能
   * 
   * @param string $word 入力した検索ワード
   */
  public function searchWord($keyword, $value)
  {
    switch ($value) {
      case '0,1';
        return $this
          ->where('title', 'like', '%' . $keyword . '%')
          ->orWhere('description', 'like', '%' . $keyword . '%')
          ->paginate(20);
        break;
      default;
        return $this
          ->where([['is_showing', $value], ['description', 'like', '%' . $keyword . '%']])
          ->orwhere([['is_showing', $value], ['title', 'like', '%' . $keyword . '%']])
          ->paginate(20);
        break;
    }
  }
  public function searchShowing($value)
  {
    return $this
      ->where('is_showing', $value)
      ->paginate(20);
  }
}
