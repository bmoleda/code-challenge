        <div class="mb-4">
            <label for="name" class="block mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ $doctor->name ?? '' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('name')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="specialty" class="block mb-2">Specialty</label>
            <input type="text" name="specialty" id="specialty" value="{{ $doctor->specialty ?? '' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('specialty')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="clinic_id_visible" class="block mb-2">Clinic</label>

            <input list="clinic_id_visible" class="bm-combo-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <datalist id="clinic_id_visible">
                <option value="">Add new (provide data below) or select</option>
                @foreach($clinics as $clinic)
                    <option data-value="{{ $clinic->id }}" {{ (!empty($doctor) && $doctor->clinic_id == $clinic->id) ? 'selected' : '' }}>{{ $clinic->name }} ({{ $clinic->address }})</option>
                @endforeach
            </datalist>
            <input type="hidden" name="clinic_id" id="clinic_id">

            @error('clinic_id')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="clinic_name" class="block mb-2">Clinic Name</label>
            <input type="text" name="clinic_name" id="clinic_name" value="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_name')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="clinic_address" class="block mb-2">Clinic Address</label>
            <input type="text" name="clinic_address" id="clinic_address" value="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_address')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
