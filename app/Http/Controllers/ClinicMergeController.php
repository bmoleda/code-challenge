<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicMergeController extends Controller
{
    public function index(Clinic $clinic)
    {
        $otherClinics = Clinic::all()->except($clinic->id);

        return view('merge-clinics.merge', compact('clinic'), compact('otherClinics'));
    }

    public function perform(Request $request, Clinic $clinic)
    {
        // Verify that the clinic_id exists and is different from the current doctor:
        $validatedData = $request->validate([
            'clinic_id' => 'exists:clinics,id|different:"' . $clinic->id . '"',
        ]);

        // Move the tests, remove the doctor:
        if ($clinicToMerge = Clinic::find($validatedData['clinic_id'])) {
            $clinicToMergeDoctors = $clinicToMerge->doctors()->get();
            foreach ($clinicToMergeDoctors as $doctor) {
                $doctor->clinic()->associate($clinic);
                $doctor->save();
            }

            $clinicToMergeTests = $clinicToMerge->tests()->get();
            foreach ($clinicToMergeTests as $test) {
                $test->referringClinic()->associate($clinic);
                $test->save();
            }

            $clinicToMerge->delete();
        }

        return redirect()->route('clinics.show', compact('clinic'))->with('success', 'Clinic was successfully merged.');
    }
}
