<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function index()
    {
        $clinics = Clinic::withCount('doctors')->orderBy('updated_at', 'desc')->paginate(100);

        return view('clinics.index', compact('clinics'));
    }

    public function create()
    {
        return view('clinics.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateInput($request);

        Clinic::create($validatedData);

        return redirect()->route('clinics.index')->with('success', 'Clinic created successfully.');
    }
    public function show(Clinic $clinic)
    {
        return view('clinics.show', compact('clinic'));
    }

    public function edit(Clinic $clinic)
    {
        return view('clinics.edit', compact('clinic'));
    }

    public function update(Request $request, Clinic $clinic)
    {
        $validatedData = $this->validateInput($request);

        $clinic->update($validatedData);

        return redirect()->route('clinics.index')->with('success', 'Clinic updated successfully.');
    }

    private function validateInput(Request $request)
    {
        return $request->validate([
            'name' => 'string',
            'address' => 'string',
        ]);
    }
}
