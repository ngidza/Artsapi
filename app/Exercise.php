<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    //
    protected $fillable = [
        'patient_id','value','activity_id','distance'
    ];
}
