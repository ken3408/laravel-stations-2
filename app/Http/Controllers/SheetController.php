<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;

class SheetController extends Controller
{
  //下記がindexアクション
  public function index()
  {
    $sheets = Sheet::all();
    $sheetArray = $sheets->toArray();
    $chunks = array_chunk($sheetArray, 5);
    return view('sheets.index', compact('chunks'));
  }
}
