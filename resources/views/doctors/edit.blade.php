@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Edit Doctor: {{ $doctor->name }}</h1>
    </div>

    <form action="{{ route('doctors.update', $doctor) }}" method="post">
        @csrf
        @method('PUT')

        <x-inputs.doctor :doctor="$doctor" :clinics="$clinics"/>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Doctor</button>
    </form>
</div>
@endsection
