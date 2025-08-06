<?php

namespace App\Services;

use App\Models\Question;

class QuestionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllQuestions($id)
    { 
        //fetch and return
        return Question::where('form_id', $id)->orderBy('question_order')->get();
    }
    public function saveQuestion($data)
    {
        // Create and return the question
        return Question::create($data);
    }
}
