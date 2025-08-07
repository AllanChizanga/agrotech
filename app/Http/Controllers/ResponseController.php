<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnswersService;
use App\Services\ResponseService;
use App\Services\RespondentsService;
use App\Http\Requests\ResponsesRequest;

class ResponseController extends Controller
{
    //attributes  

    private $respondentService; 
    private $responseService;
    private $answersService;



    //constructor  

    public function __construct(RespondentsService $respondentService,ResponseService $responseService,AnswersService $answersService)
    {
          $this->respondentService = $respondentService; 
        $this->responseService = $responseService;
        $this->answersService = $answersService;
    }

    //methods  

    public function responses(ResponsesRequest $request)
    { 

       $data = $request->validated();  

       //first create a respondent 
       $respondent = $this->respondentService->createRespondent($data['respondent']);

       //then create a response 

       $response = $this->responseService->createResponse($data['form_id'],$respondent->id); 


       //then create a answer  

       $res = $this->answersService->createAnswers($data['answers'],$response->id); 

       if($res)
       {
        return response()->json(['message'=>'response has been submitted successfully'],200);
       }

       else{
       return response()->json(['message' => 'Failed to submit response'], 500);
       }



    }//endof function 
}
