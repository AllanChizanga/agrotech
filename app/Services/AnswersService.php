<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use App\Actions\SaveFile;

class AnswersService
{ 

     private $saveFile; 
    /**
     * Create a new class instance.
     */
    public function __construct(SaveFile $saveFile)
    {
        $this->saveFile = $saveFile;
    } 

    //function to create answers 

    public function createAnswers($answers, $response_id)
    {
        foreach ($answers as $answer) {  

            //check if the question type is image,video or document then save the file according in answer_text 
            // Use question_id to get the Question model and check its question_type
            $question = Question::find($answer['question_id'] ?? null);
            if (
                $question &&
                in_array($question->question_type, ['image', 'video', 'document'])
            ) {
               $path =  $this->saveFile->saveFile($answer['answer_text']);
            }
            $option_id = $answer['option_id'] ?? null;
            if ($option_id == -1) {
                $option_id = null;
            }

            Answer::create([
                'response_id' => $response_id,
                'question_id' => $answer['question_id'] ?? null,
                'answer_text' => isset($path) ? $path : ($answer['answer_text'] ?? null),
                'option_id' => $option_id,
                'image_gps_location' => $answer['image_gps_location'] ?? null,
            ]);
            unset($path); 
        }
        return true;
    }
}
