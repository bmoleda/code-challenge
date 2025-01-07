@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Edit Doctor: {{ $doctor->name }}</h1>
    </div>

    <form action="{{ route('doctors.update', $doctor) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $doctor->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('name')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="specialty" class="block mb-2">Specialty</label>
            <input type="text" name="specialty" id="specialty" value="{{ old('specialty', $doctor->specialty) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('specialty')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="clinic_id" class="block mb-2">Clinic</label>
            <select name="clinic_id" id="clinic_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Add new (provide data below) or select</option>
                @foreach($clinics as $clinic)
                    <option value="{{ $clinic->id }}" {{ $doctor->clinic_id == $clinic->id ? 'selected' : 'data-dump['. old('clinic_id'). ']' }}>{{ $clinic->name }} ({{ $clinic->address }})</option>
                @endforeach
            </select>
            @error('clinic_id')
            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="clinic_name" class="block mb-2">Clinic Name</label>
            <input type="text" name="clinic_name" id="clinic_name" value="{{ old('clinic_name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_name')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="clinic_address" class="block mb-2">Clinic Address</label>
            <input type="text" name="clinic_address" id="clinic_address" value="{{ old('clinic_address') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_address')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Doctor</button>
    </form>
</div>
@endsection
