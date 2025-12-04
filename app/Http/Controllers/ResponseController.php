<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnswersService;
use App\Services\ResponseService;
use App\Services\RespondentsService;
use App\Services\QuestionnaireService;
use App\Http\Requests\ResponsesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Respondent;
use App\Models\SurveySet;
use App\Models\Response as ResponseModel;
use App\Models\Form;;
use App\Models\RespondentProgress;

class ResponseController extends Controller
{
    private $respondentService;
    private $responseService;
    private $answersService;
    private $questionnaireService;

    public function __construct(
        RespondentsService $respondentService,
        ResponseService $responseService,
        AnswersService $answersService,
        QuestionnaireService $questionnaireService
    ) {
        $this->respondentService = $respondentService;
        $this->responseService = $responseService;
        $this->answersService = $answersService;
        $this->questionnaireService = $questionnaireService;
    }

    /**
     * Submit responses, update survey set progress, and return updated progress
     */
    public function responses(ResponsesRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {

            // 1. Create or fetch respondent
            $respondent = $this->respondentService->createRespondent($data['respondent']);

            // 2. Create the response record
            $response = $this->responseService->createResponse($data['form_id'], $respondent->id);

            // 3. Store answers
            $this->answersService->createAnswers($data['answers'], $response->id);

            // 4. Update survey-set progress
            $updatedSurveySets = [];
            $form = Form::with('surveySets.forms')->find($data['form_id']);

            if ($form) {

                foreach ($form->surveySets as $set) {

                    // ======== STEP 1: Load survey-set form IDs ========
                    $setForms = $set->forms;
                    $setFormIds = $setForms->pluck('id')->toArray();
                    $totalForms = count($setFormIds);

                    // ======== STEP 2: Find unique forms respondent completed in this set ========
                    $completedForms = ResponseModel::where('respondent_id', $respondent->id)
                        ->whereIn('form_id', $setFormIds)
                        ->pluck('form_id')
                        ->unique()
                        ->toArray();

                    // Count safely
                    $completedCount = min(count($completedForms), $totalForms);

                    // ======== STEP 3: Update or create progress row ========
                    RespondentProgress::updateOrCreate(
                        [
                            'respondent_id' => $respondent->id,
                            'survey_set_id' => $set->id,
                        ],
                        [
                            'total_forms' => $totalForms,
                            'completed_forms' => $completedCount,
                        ]
                    );

                    // ======== STEP 4: Build detailed forms for response ========
                    $formsDetailed = $setForms->map(function ($form) use ($completedForms) {
                        return [
                            'id' => $form->id,
                            'title' => $form->title,
                            'completed' => in_array($form->id, $completedForms),
                        ];
                    });

                    // ======== STEP 5: Push survey-set data to API response ========
                    $updatedSurveySets[] = [
                        'survey_set_id' => $set->id,
                        'title' => $set->title,
                        'description' => $set->description,
                        'total_forms' => $totalForms,
                        'completed_forms' => $completedCount,
                        'progress_percentage' => $totalForms > 0
                            ? round(($completedCount / $totalForms) * 100, 2)
                            : 0,
                        'forms' => $formsDetailed,
                    ];
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Response submitted successfully',
                'respondent' => [
                    'id' => $respondent->id,
                    'fullname' => $respondent->fullname,
                    'national_id' => $respondent->national_id,
                    'phone' => $respondent->phone,
                    'email' => $respondent->email,
                    'city' => $respondent->city,
                    'country' => $respondent->country,
                ],
                'survey_sets' => $updatedSurveySets,
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to submit response', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit response',
            ], 500);
        }
    }


    /**
     * Get all survey sets for a respondent with progress and detailed info
     */
    public function surveySetsWithProgress($respondentId)
    {
        $respondent = Respondent::find($respondentId);

        if (!$respondent) {
            return response()->json([
                'success' => false,
                'message' => 'Respondent not found',
            ], 404);
        }

        // Load all survey sets with forms
        $surveySets = SurveySet::with('forms')->get();
        $result = [];

        foreach ($surveySets as $set) {

            // Fetch pre-calculated progress stored in RespondentProgress
            $progress = RespondentProgress::where('respondent_id', $respondentId)
                ->where('survey_set_id', $set->id)
                ->first();

            $completedForms = $progress->completed_forms ?? 0;
            $totalForms     = $progress->total_forms ?? $set->forms->count();

            // Only calculate % here
            $percentage = $totalForms > 0 
                ? round(($completedForms / $totalForms) * 100, 2)
                : 0;

            // Build forms list
            $formsDetailed = $set->forms->map(function ($form) use ($progress) {
                $completed = $progress 
                    ? in_array($form->id, $progress->completed_form_ids ?? [])
                    : false;

                return [
                    'id'        => $form->id,
                    'title'     => $form->title,
                    'completed' => $completed,
                ];
            });

            // Add to final result
            $result[] = [
                'survey_set_id'        => $set->id,
                'title'                => $set->title,
                'description'          => $set->description,
                'total_forms'          => $totalForms,
                'completed_forms'      => $completedForms,
                'progress_percentage'  => $percentage,
                'forms'                => $formsDetailed,
            ];
        }

        return response()->json([
            'success' => true,
            'respondent' => [
                'id'          => $respondent->id,
                'fullname'    => $respondent->fullname,
                'national_id' => $respondent->national_id,
                'phone'       => $respondent->phone,
                'email'       => $respondent->email,
                'city'        => $respondent->city,
                'country'     => $respondent->country,
            ],
            'survey_sets' => $result,
        ], 200);
    }

}
