<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return [
      'title' => '映画タイトル',
      'image_url' => '画像URL',
      'published_year' => '公開年',
      'description' => '概要',
      'is_showing' => '公開中かどうか',
    ];
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title' => ['required', 'unique:movies'],
      'image_url' => ['required', 'url'],
      'published_year' => ['required'],
      'description' => ['required'],
      'is_showing' => ['required', 'boolean'],
      'genre' => ['required']
      //'genre' => ['required'],
    ];
  }
}
