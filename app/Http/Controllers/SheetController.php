<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;

class SheetController extends Controller
{
  //５列３行に並べる場合
  /*  public function index()
  {
    $sheets = Sheet::all();
    $sheetArray = $sheets->toArray();
    $chunks = array_chunk($sheetArray, 5);
    return view('sheets.index', compact('chunks'));
  }*/
  public function index()
  {
    $sheets = Sheet::all();
    return view('sheets.index', compact('sheets'));
  }
}
