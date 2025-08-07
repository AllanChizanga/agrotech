<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuestionnaireService;

class QuestionnaireController extends Controller
{
    //attributes 

    private $service; 




    //constructor  

    public function __construct(QuestionnaireService $service)
    { 

       $this->service = $service; 

    } //endof constructor

    //methods  

    //method  to retrive all the available questionnaires
    public function questionnaires()
    { 
        
        $res =  $this->service->getFormsForDataCollector();  

        return response()->json(['data'=>$res],200); 

    }//endof function  
 

    public function getQuestionsWithOptions($questionnaire_id)
    {

        $question = $this->service->getQuestionsWithOptions($questionnaire_id); 

        return response()->json(['data'=>$res],200); 


    }

}//endof controller 
