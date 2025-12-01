<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SurveySet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function forms()
    {
        return $this->belongsToMany(Form::class, 'survey_set_form')
            ->withPivot('order')
            ->orderBy('survey_set_form.order');
    }

    public function progress()
    {
        return $this->hasMany(RespondentProgress::class);
    }

    public function respondent_progress()
    {
        return $this->hasMany(RespondentProgress::class);
    }
}
