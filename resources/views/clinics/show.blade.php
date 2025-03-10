@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Clinic Detail: {{ $clinic->name }}</h1>
        <a href="{{ route('clinics.edit', $clinic) }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit Clinic</a>
    </div>
    <div class="flex items-center justify-end mb-4">
        <a href="{{ route('merge-clinics', $clinic) }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Merge Clinic</a>
    </div>

    <div class="mb-4">
        <strong>Name:</strong> {{ $clinic->name }}
    </div>
    <div class="mb-4">
        <strong>Address:</strong> {{ $clinic->address }}
    </div>

    <h2 class="text-xl font-bold mb-4">Related Doctors</h2>
    <table class="bg-white w-full border-collapse">
        <thead>
            <tr class="bg-gray-300">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Updated</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Specialty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clinic->doctors()->orderBy('created_at', 'desc')->get() as $doctor)
                <tr>
                    <td class="border px-4 py-2">{{ $doctor->id }}</td>
                    <td class="border px-4 py-2">{{ $doctor->updated_at->format('Y-m-d') }}</td>
                    <td class="border px-4 py-2">{{ $doctor->name }}</td>
                    <td class="border px-4 py-2">{{ $doctor->specialty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
