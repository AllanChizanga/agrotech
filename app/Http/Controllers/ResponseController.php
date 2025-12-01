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

            // 2. Create response
            $response = $this->responseService->createResponse($data['form_id'], $respondent->id);

            // 3. Create answers
            $this->answersService->createAnswers($data['answers'], $response->id);

            // 4. Update survey set progress
            $form = \App\Models\Form::find($data['form_id']);
            $updatedSurveySets = [];

            if ($form) {
                $surveySets = $form->surveySets;

                foreach ($surveySets as $set) {
                    $progress = \App\Models\RespondentProgress::firstOrCreate(
                        [
                            'respondent_id' => $respondent->id,
                            'survey_set_id' => $set->id,
                        ],
                        [
                            'completed_forms' => 0,
                            'total_forms' => $set->forms()->count(),
                        ]
                    );

                    $completedForms = ResponseModel::whereIn('form_id', $set->forms->pluck('id'))
                        ->where('respondent_id', $respondent->id)
                        ->pluck('form_id')
                        ->toArray();

                    $progress->completed_forms = count($completedForms);
                    $progress->save();

                    // Include updated survey set progress in response
                    $formsDetailed = $set->forms->map(function ($form) use ($completedForms) {
                        return [
                            'id' => $form->id,
                            'title' => $form->title,
                            'completed' => in_array($form->id, $completedForms),
                        ];
                    });

                    $updatedSurveySets[] = [
                        'survey_set_id' => $set->id,
                        'title' => $set->title,
                        'description' => $set->description,
                        'total_forms' => $set->forms->count(),
                        'completed_forms' => count($completedForms),
                        'progress_percentage' => $set->forms->count() > 0 ? round(count($completedForms) / $set->forms->count() * 100, 2) : 0,
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

        $surveySets = SurveySet::with(['forms'])->get();
        $result = [];

        foreach ($surveySets as $set) {
            $totalForms = $set->forms->count();

            $completedForms = ResponseModel::whereIn('form_id', $set->forms->pluck('id'))
                ->where('respondent_id', $respondentId)
                ->pluck('form_id')
                ->toArray();

            $formsDetailed = $set->forms->map(function ($form) use ($completedForms) {
                return [
                    'id' => $form->id,
                    'title' => $form->title,
                    'completed' => in_array($form->id, $completedForms),
                ];
            });

            $result[] = [
                'survey_set_id' => $set->id,
                'title' => $set->title,
                'description' => $set->description,
                'total_forms' => $totalForms,
                'completed_forms' => count($completedForms),
                'progress_percentage' => $totalForms > 0 ? round(count($completedForms) / $totalForms * 100, 2) : 0,
                'forms' => $formsDetailed,
            ];
        }

        return response()->json([
            'success' => true,
            'respondent' => [
                'id' => $respondent->id,
                'fullname' => $respondent->fullname,
                'national_id' => $respondent->national_id,
                'phone' => $respondent->phone,
                'email' => $respondent->email,
                'city' => $respondent->city,
                'country' => $respondent->country,
            ],
            'survey_sets' => $result,
        ], 200);
    }
}
