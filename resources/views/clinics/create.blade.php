@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Add Clinic</h1>

    <form action="{{ route('clinics.store') }}" method="post">
        @csrf

        <x-inputs.clinic/>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Clinic</button>
    </form>
</div>
@endsection
