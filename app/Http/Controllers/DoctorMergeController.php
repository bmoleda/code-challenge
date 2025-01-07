<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorMergeController extends Controller
{
    public function index(Doctor $doctor)
    {
        $otherDoctors = Doctor::all()->except($doctor->id);

        return view('merge-doctors.merge', compact('doctor'), compact('otherDoctors'));
    }

    public function perform(Request $request, Doctor $doctor)
    {
        // Verify that the doctor_id exists and is different from the current doctor:
        $validatedData = $request->validate([
            'doctor_id' => 'exists:doctors,id|different:"' . $doctor->id . '"',
        ]);

        // Move the tests, remove the doctor:
        if ($doctorToMerge = Doctor::find($validatedData['doctor_id'])) {
            $doctorToMergeTests = $doctorToMerge->tests()->get();
            foreach ($doctorToMergeTests as $test) {
                $test->referringDoctor()->associate($doctor);
                $test->save();
            }

            $doctorToMerge->delete();
        }

        return redirect()->route('doctors.show', compact('doctor'))->with('success', 'Doctor was successfully merged.');
    }
}
