<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'index_number',
        'date_of_birth',
        'contact_number',
        'placement_id',
        'stream',
        'supw',
        'eligibility_criteria_id',
        'eng',
        'dzo',
        'com',
        'acc',
        'bmt',
        'geo',
        'his',
        'eco',
        'med',
        'bent',
        'evs',
        'rige',
        'agfs',
        'mat',
        'phy',
        'che',
        'bio',
        'eligibility_status',
        'rank',        
        'program_applied',
    ];

    public function rankingCriteria() {
        return $this->belongsTo(RankingCriteria::class, 1);
    }

    // Define any relationships (e.g., belongsTo, hasMany) with other models here
}
