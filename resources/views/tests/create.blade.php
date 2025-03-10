@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Add Test</h1>

    <form action="{{ route('tests.store') }}" method="post">
        @csrf

        <div class="mb-4">
            <label for="name" class="block mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('name')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-2">Description</label>
            <input type="text" name="description" id="description" value="{{ old('description') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('description')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="referring_doctor_id_visible" class="block mb-2">Referring Doctor</label>

            <input list="referring_doctor_id_visible" class="bm-combo-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <datalist id="referring_doctor_id_visible">
                <option data-value="" value="Select Doctor">
                @foreach($doctors as $doctor)
                    <option data-value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->clinic->name }})</option>
                @endforeach
            </datalist>
            <input type="hidden" name="referring_doctor_id" id="referring_doctor_id">

            @error('referring_doctor_id')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Test</button>
    </form>
</div>
@endsection
