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
        'bio',
        'eng_required',
        'dzo_required',
        'com_required',
        'acc_required',
        'bmt_required',
        'geo_required',
        'his_required',
        'eco_required',
        'med_required',
        'bent_required',
        'evs_required',
        'rige_required',
        'agfs_required',
        'mat_required',
        'phy_required',
        'che_required',
        'bio_required',
    ];
}