<?php

namespace App\Services;

use App\Models\Response;

class ResponseServive
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
}
