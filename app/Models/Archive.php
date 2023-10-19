<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archive';

    protected $fillable = ['fileURL', 'archivedDate', 'archivedBy'];

    // Add any additional properties, relationships, or methods as needed
}
