<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Response;

class ResponseService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }  

    //function to create a new response

    public function createResponse($form_id,$respondent_id)
    { 

       return Response::create([
            'form_id'=>$form_id, 
            'respondent_id'=>$respondent_id,
        ]) ;

    }//endof function 

    //function to return responses with respondents, answers, options   

    public function responses($id)
    { 

        //question id 

        //load answers to this question with respondent, option 

        // Corrected: Add missing import and ensure Answer model is referenced
        return Answer::where('question_id', $id)
            ->with(['response.respondent', 'option'])
            ->get();

    }


}//endof class 
