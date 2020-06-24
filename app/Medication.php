<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = [
        'patient_id', 'stage','value','medication_id', 'dosage_id', 'pills','effects_id', 'notes'
    ];
}
