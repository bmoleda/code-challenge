@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Merge into Clinic: {{ $clinic->name }}</h1>
    </div>

    <form action="{{ route('merge-clinics-perform', $clinic) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="clinic_id" class="block mb-2">Choose a Clinic to merge into the Clinic above:</label>

            <select name="clinic_id" id="clinic_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select Clinic</option>
                @foreach($otherClinics as $clinic)
                    <option value="{{ $clinic->id }}">{{ $clinic->name }} ({{ $clinic->address }})</option>
                @endforeach
            </select>
            <p class="text-500 mt-1">Doctors and Tests associated with the selected Clinic are going to be assigned to the other Clinic.</p>
            @error('clinic_id')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Merge Clinic</button>
    </form>
</div>
@endsection

