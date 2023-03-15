<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
  use HasFactory;
  protected $table = 'genres';

  public function movies()
  {
    return $this->hasMany(Movie::class);
  }
  protected $fillable = [
    'name',
    'created_at',
    'updated_at	',
  ];
}
