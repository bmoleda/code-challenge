<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\ClinicMergeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorMergeController;
use App\Http\Controllers\TestController;

Route::get('/', function() {
    return redirect()->route('doctors.index');
});

Route::resource('doctors', DoctorController::class);
Route::resource('tests', TestController::class);
Route::resource('clinics', ClinicController::class);

Route::get('/merge-doctors/{doctor}', [DoctorMergeController::class, 'index'])->name('merge-doctors');
Route::put('/merge-doctors/perform/{doctor}', [DoctorMergeController::class, 'perform'])->name('merge-doctors-perform');
Route::get('/merge-clinics/{clinic}', [ClinicMergeController::class, 'index'])->name('merge-clinics');
Route::put('/merge-clinics/perform/{clinic}', [ClinicMergeController::class, 'perform'])->name('merge-clinics-perform');
