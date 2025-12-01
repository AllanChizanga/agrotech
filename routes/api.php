<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\QuestionnaireController;

// ------------------------
// Public routes
// ------------------------
Route::controller(UserController::class)->group(function() {
    // Route for the data collector to login
    Route::post('login', 'authenticateApi');
});

// ------------------------
// Protected routes (Sanctum)
// ------------------------
Route::middleware('auth:sanctum')->group(function() {

    // ------------------------
    // Questionnaire routes
    // ------------------------
    Route::controller(QuestionnaireController::class)->group(function() {
        // Get all questionnaires
        Route::get('questionnaires', 'questionnaires');

        // Get questions with options for a specific questionnaire
        Route::get('questions/{questionnaire_id}', 'getQuestionsWithOptions');
    });

    // ------------------------
    // Response routes
    // ------------------------
    Route::controller(ResponseController::class)->group(function() {
        // Post responses with respondents
        Route::post('responses_with_respondents', 'responses');

        // Get survey sets with progress for a respondent
        Route::get('survey_sets/{respondentId}', 'surveySetsWithProgress');
    });

});
