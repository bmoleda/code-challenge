@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Clinics</h1>
            <a href="{{ route('clinics.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Clinic</a>
        </div>

        <hr>
        <br>
        {{ $clinics->links() }}
        <br>
        <hr>

        <table class="bg-white w-full border-collapse">
            <thead>
                <tr class="bg-gray-300">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Updated</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Address</th>
                    <th class="border px-4 py-2"># Doctors</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clinics as $clinic)
                    <tr>
                        <td class="border px-4 py-2">{{ $clinic->id }}</td>
                        <td class="border px-4 py-2">{{ $clinic->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td class="border px-4 py-2">{{ $clinic->name }}</td>
                        <td class="border px-4 py-2">{{ $clinic->address }}</td>
                        <td class="border px-4 py-2">{{ $clinic->doctors_count }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('clinics.show', $clinic) }}" class="text-blue-500">View</a>
                            <a href="{{ route('clinics.edit', $clinic) }}" class="text-green-500">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
