<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    protected $table = 'placement'; // Set the table name

    protected $fillable = ['location', 'time']; // Define fillable columns

    public function students()
    {
        return $this->hasMany(Student::class, 'placement_id');
    }
}

