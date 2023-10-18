<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
    protected $table = 'eligibility'; // Name of the table in the database

    protected $fillable = [
        'eng', 'dzo', 'com', 'acc', 'bmt', 'geo', 'his', 'eco', 'med', 'bent', 'evs', 'rige', 'agfs', 'mat', 'phy', 'che', 'bio',
    ];

    // You can define relationships with other models here, such as belongsTo or hasMany.
}
