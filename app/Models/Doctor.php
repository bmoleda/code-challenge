<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tests()
    {
        return $this->hasMany(Test::class, 'referring_doctor_id');
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(related: Clinic::class, foreignKey: 'clinic_id');
    }
}
