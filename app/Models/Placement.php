<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    protected $table = 'placement'; // Set the table name

    protected $fillable = ['location', 'time']; // Define fillable columns
}
