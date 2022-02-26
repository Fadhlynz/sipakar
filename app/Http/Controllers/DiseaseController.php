<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    public function store(Request $request)
    {
      $request->validate([
        'name' => 'required',
        'detail' => 'required',
        'solution' => 'required',
        'image' => 'required',
      ]);

      $foto = $request->file('image');
      $fileName = $request->name . '.' . $foto[0]->getClientOriginalExtension();

      $path = $request->image[0]->storeAs('public/gambar', $fileName);

      Disease::create([
        'name' => $request->name,
        'detail' => $request->detail,
        'solution' => $request->solution,
        'image' => $path,
      ]);

      return back();
    }

    public function data()
    {
      return Disease::latest()->get();
    }
}
