<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Doctor;
use App\Models\Clinic;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->unsignedBigInteger('referring_clinic_id')->nullable();
            $table->foreign('referring_clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });

        // Data migration done in one go; normally we may want to handle it as a separate script/Command:
        foreach (Doctor::all() as $doctor) {
            $clinic = Clinic::create([
                'name' => $doctor->clinic_name,
                'address' => $doctor->clinic_address,
            ]);

            foreach ($doctor->tests()->get() as $test) {
                $test->referringClinic()->associate($clinic);
                $test->save();
            }

            $doctor->clinic()->associate($clinic);
            $doctor->save();
        }

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('clinic_name');
            $table->dropColumn('clinic_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('clinic_name')->nullable();
            $table->string('clinic_address')->nullable();
        });

        foreach (Doctor::all() as $doctor) {
            $doctor->clinic_name = $doctor->clinic?->name;
            $doctor->clinic_address = $doctor->clinic?->address;
            $doctor->clinic()->dissociate();

            foreach ($doctor->tests() as $test) {
                $test->referringClinic()->dissociate();
                $test->save();
            }

            $doctor->save();
        }

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('clinic_id');
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn('referring_clinic_id');
        });

        Schema::dropIfExists('clinics');
    }
};
