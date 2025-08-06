<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'form_id',
        'question_text',
        'question_type',
        'is_required',
        'question_order',
        'depends_on_question',
        'depends_on_answer'
    ];
    

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}