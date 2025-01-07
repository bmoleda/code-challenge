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
        $validatedData = $this->validateInput($request);

        Doctor::create($validatedData);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $clinics = Clinic::all();

        return view('doctors.edit', compact('doctor'), compact('clinics'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $validatedData = $this->validateInput($request);

        $doctor->update($validatedData);
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }
    private function validateInput(StoreDoctorRequest|UpdateDoctorRequest $request)
    {
        $validatedData = $request->validated();

        // If clinic_id has been excluded in the validation, process a new clinic:
        if (!isset($validatedData['clinic_id'])) {
            $newClinicAttr = [
                'name' => $validatedData['clinic_name'],
                'address' => $validatedData['clinic_address'],
            ];
            unset($validatedData['clinic_name']);
            unset($validatedData['clinic_address']);

            $newClinic = Clinic::create($newClinicAttr);

            $validatedData['clinic_id'] = $newClinic->id;
        }

        return $validatedData;
    }
}
