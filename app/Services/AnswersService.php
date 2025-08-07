<?php

namespace App\Services;

use App\Models\Answer;

class AnswersService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    } 

    //function to create answers 

    public function createAnswers($answers, $response_id)
    {
        foreach ($answers as $answer) {
            Answer::create([
                'response_id' => $response_id,
                'question_id' => $answer['question_id'] ?? null,
                'answer_text' => $answer['answer_text'] ?? null,
                'option_id' => $answer['option_id'] ?? null,
            ]);
        }
        return true;
    }
}
