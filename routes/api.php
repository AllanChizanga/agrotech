<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\QuestionnaireController;




//authentication route for the data collector user 

Route::controller(UserController::class)->group(function(){

    //route for the data collector to login 

    Route::post('login','authenticateApi');

}); 
 

//protected routes 

Route::controller(QuestionnaireController::class)->group(function(){

    //route to get all questionnaires 
 
    Route::get('questionnaires','questionnaires');
    

    //route to get questionnaire questions and options 

    Route::get('questions/{questionnaire_id}','getQuestionsWithOptions');

  





})->middleware('auth:sanctum'); 

//protected routes for posting responses
Route::controller(ResponseController::class)->group(function(){ 

 //route to post responses with the respondents 

 Route::post('responses_with_respondents','responses');


})->middleware('auth:sanctum'); 