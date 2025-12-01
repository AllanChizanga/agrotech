<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveySetForm extends Model
{
    protected $table = 'survey_set_form';

    protected $fillable = [
        'survey_set_id',
        'form_id',
        'order',
    ];
}
