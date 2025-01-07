<?php
namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::with('referringDoctor')->orderBy('updated_at', 'desc')->paginate(100);

        return view('tests.index', compact('tests'));
    }

    public function create()
    {
        $doctors = Doctor::all();

        return view('tests.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => '',
            'referring_doctor_id' => 'exists:doctors,id',
        ]);

        // Derive the referring clinic from the referring doctor:
        $validatedData['referring_clinic_id'] = Doctor::find($validatedData['referring_doctor_id'])?->clinic_id ?? null;

        Test::create($validatedData);

        return redirect()->route('tests.index')->with('success', 'Test created successfully.');
    }
}
