<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PatientsController extends Controller
{
    public function index()
    {
        return inertia('Admin/Patients', [
        'patients' => Patient::paginate(10),
        ]);
    }

    public function insert(Request $request)
    {
        $request->validate([
        'nik' => ['required', 'unique:patients'],
        'name' => 'required',
        'born_place' => 'required',
        'born_date' => 'required',
        'gender' => 'required',
        'address' => 'required',
        'job' => 'required',
        'hp' => ["required"]
        ]);

        Patient::create([
        'nik' => $request->nik,
        'name' => $request->name,
        'born_place' => $request->born_place,
        'born_date' => $request->born_date,
        'gender' => $request->gender,
        'address' => $request->address,
        'job' => $request->job,
        'hp' => $request->hp
        ]);

        return back();
    }

    public function update(Request $request)
    {
    $request->validate([
    'id' => 'required',
    'nik' => 'required',
    'name' => 'required',
    'born_place' => 'required',
    'born_date' => 'required',
    'gender' => 'required',
    'address' => 'required',
    'hp' => 'required',
    'job' => 'required'
    ]);

    $nik = Patient::where('nik', $request->nik)->whereNotIn('id', [$request->id])->get();

    if (count($nik) > 0) {
    throw ValidationException::withMessages([
    'duplicate' => 'NIK sudah terdaftar!'
    ]);
    } else {
    Patient::where('id', $request->id)->update([
        'nik' => $request->nik,
        'name' => $request->name,
        'born_place' => $request->born_place,
        'born_date' => $request->born_date,
        'gender' => $request->gender,
        'address' => $request->address,
        'hp' => $request->hp,
        'job' => $request->job,
    ]);
    }

    return back();
    }

    public function delete(Request $request)
    {
    Patient::where('id', $request->id)->delete();

    return back();
    }

    public function data()
    {
    return Patient::latest()->get();
    }
}
