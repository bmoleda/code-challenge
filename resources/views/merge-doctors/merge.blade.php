@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Merge into Doctor: {{ $doctor->name }}</h1>
    </div>

    <form action="{{ route('merge-doctors-perform', $doctor) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="doctor_id_visible" class="block mb-2">Choose a Doctor to merge into the Doctor above:</label>

            <input list="doctor_id_visible" class="bm-combo-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <datalist id="doctor_id_visible">
                <option value="">Select Doctor</option>
                @foreach($otherDoctors as $doctor)
                    <option data-value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->clinic?->name }})</option>
                @endforeach
            </datalist>
            <input type="hidden" name="doctor_id" id="doctor_id">

            <p class="text-500 mt-1">Tests associated with the selected Doctor are going to be assigned to the other Doctor.</p>
            @error('doctor_id')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Merge Doctor</button>
    </form>
</div>
@endsection

