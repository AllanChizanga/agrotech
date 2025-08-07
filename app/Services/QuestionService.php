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
    }//end of function  

    //function to update a question 

    public function update($data)
    { 
         
    // Find the question by its text (assuming editingQuestionText is unique enough for update)
    $question = Question::where('question_text', $data['editingQuestionText'])->first();


    if (!$question) {
        // Could not find the question to update
        return false;
    }

    // Update the fields that are present in $data
 
        $question->question_text = $data['editingQuestionText']??'';
        $question->question_order = $data['editingQuestionOrder']??'';

        $question->save();

        return true;

    }//endof function


    //function to delete a question 

    public function delete(Question $qtn)
    {
        $qtn->delete(); 

        return true; 
    }//endof function 

}//endof service class
