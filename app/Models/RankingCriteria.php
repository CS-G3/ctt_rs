<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingCriteria extends Model
{
    protected $table = 'ranking_criteria'; 
    protected $primaryKey = 'ranking_criteria_id';

    protected $fillable = [
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
        'bio'
    ];
}