<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RegistrationPeriod extends Model
{
    protected $fillable = ['startDate', 'endDate'];

    protected $table = 'registration_period'; // Define the table name if it differs from Laravel's default naming conventions

    public function getStatusAttribute()
    {
        $now = Carbon::now();
        $startDate = Carbon::parse($this->startDate);
        $endDate = Carbon::parse($this->endDate);

        return $now->between($startDate, $endDate);
    }
}
