<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RespondentProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'respondent_id',
        'survey_set_id',
        'completed_forms',
        'total_forms',
    ];

    public function respondent()
    {
        return $this->belongsTo(Respondent::class);
    }

    public function surveySet()
    {
        return $this->belongsTo(SurveySet::class);
    }
}
