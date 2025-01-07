<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::withCount('tests')->orderBy('updated_at', 'desc')->paginate(100);

        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $clinics = Clinic::all();

        return view('doctors.create', compact('clinics'));

    }

    public function store(StoreDoctorRequest $request)
    {
        $validatedData = $request->validate([
            'name' => '',
            'specialty' => '',
            'clinic_id' => 'exists:clinics,id',
        ]);

        Doctor::create($validatedData);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->validated());
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }
}
