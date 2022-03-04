<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function store(Request $request)
    {
      $request->validate([
        'name' => 'required',
        'code' => 'required|unique:symptom',
      ],[
        'name.required' => 'Nama gejala harus diisi!',
        'code.required' => 'Kode gejala harus diisi!',
        'code.unique' => 'Kode gejala sudah digunakan!',
      ]);

      Symptom::create([
        'name' => $request->name,
        'code' => $request->code,
      ]);

      return back();
    }
}
