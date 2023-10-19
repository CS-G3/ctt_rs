<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationPeriod extends Model
{
    protected $table = 'registration_period';

    protected $fillable = [
        'startDate',
        'endDate',
        'STATUS',
    ];

    // Your model methods and relationships can be defined here
}
