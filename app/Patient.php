<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'firstname', 'surname','healthunit_id', 'gender_id', 'dateofbirth','artnumber', 'primarycell', 'secondarycell', 'messagelanguage_id',
        'messagemode_id'
    ];
}
