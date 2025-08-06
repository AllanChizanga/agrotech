<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'form_id',
        'respondent_id',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function respondent(): BelongsTo
    {
        return $this->belongsTo(Respondent::class, 'respondent_id');
    }   
}
