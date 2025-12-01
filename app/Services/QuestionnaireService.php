<?php

namespace App\Services;

use Log;
use Exception;
use App\Models\Form;
use App\Models\Question;
use App\Models\SurveySet;
use App\Models\SurveySetForm;
use App\Models\RespondentProgress;
use Illuminate\Support\Facades\DB;

class QuestionnaireService
{
    private $authUser;

    public function __construct()
    {
        $this->authUser = auth()->user();
    }

    // -----------------------
    // FORMS
    // -----------------------
    public function getAllForms()
    {
        return Form::where('user_id', $this->authUser->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function get_all()
    {
        // Fetch all forms belonging to the authenticated user, ordered by latest
        return Form::all();
    }//endof func


    public function saveForm(array $data)
    {
        $data['user_id'] = $this->authUser->id;
        $data['is_public'] = $data['is_public'] ?? true;

        try {
            Form::create($data);
            return true;
        } catch (Exception $e) {
            Log::error('Failed to save form: '.$e->getMessage(), ['data' => $data]);
            return false;
        }
    }

    public function updateForm(array $data)
    {
        $form = Form::where('id', $data['id'])->where('user_id', $this->authUser->id)->first();
        if (!$form) return false;

        $form->title = $data['editingFormTitle'] ?? $data['title'] ?? $form->title;
        $form->description = $data['editingFormDescription'] ?? $data['description'] ?? $form->description;
        $form->category = $data['editingFormCategory'] ?? $data['category'] ?? $form->category;
        $form->status = $data['editingFormStatus'] ?? $data['status'] ?? $form->status;

        try {
            $form->save();
            return true;
        } catch (Exception $e) {
            Log::error('Failed to update form: '.$e->getMessage(), ['data' => $data]);
            return false;
        }
    }

    public function deleteForm(Form $form)
    {
        try {
            $form->delete();
            return true;
        } catch (Exception $e) {
            Log::error('Failed to delete form: '.$e->getMessage(), ['form_id' => $form->id]);
            return false;
        }
    }

    public function getQuestionsWithOptions($formId)
    {
        return Question::where('form_id', $formId)->with('options')->get();
    }

    // -----------------------
    // SURVEY SETS
    // -----------------------
    public function getAllSurveySets($search = null)
    {
        $query = SurveySet::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('title', 'like', "%$search%");
        }
        return $query->get();
    }

    public function saveSet(array $data)
    {
        $data['user_id'] = $this->authUser->id;
        try {
            SurveySet::create($data);
            return true;
        } catch (Exception $e) {
            Log::error('Failed to save set: '.$e->getMessage(), ['data' => $data]);
            return false;
        }
    }

    public function updateSet(array $data)
    {
        $set = SurveySet::find($data['id']);
        if (!$set) return false;

        $set->title = $data['title'] ?? $set->title;
        $set->description = $data['description'] ?? $set->description;

        try {
            $set->save();
            return true;
        } catch (Exception $e) {
            Log::error('Failed to update set: '.$e->getMessage(), ['data' => $data]);
            return false;
        }
    }

    public function deleteSet(SurveySet $set)
    {
        try {
            $set->delete();
            return true;
        } catch (Exception $e) {
            Log::error('Failed to delete set: '.$e->getMessage(), ['set_id' => $set->id]);
            return false;
        }
    }

    public function getFormsForSet($setId)
    {
        $set = SurveySet::find($setId);
        if (!$set) return collect();
        return $set->forms()->orderBy('survey_set_form.order')->get();
    }

    public function attachFormsToSet($setId, array $formIds)
    {
        $set = SurveySet::find($setId);
        if (!$set) return false;

        DB::beginTransaction();
        try {
            $maxOrder = SurveySetForm::where('survey_set_id', $setId)->max('order') ?? 0;
            foreach ($formIds as $fid) {
                $exists = SurveySetForm::where('survey_set_id', $setId)->where('form_id', $fid)->exists();
                if (!$exists) {
                    SurveySetForm::create([
                        'survey_set_id' => $setId,
                        'form_id' => $fid,
                        'order' => ++$maxOrder,
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to attach forms: '.$e->getMessage(), ['set_id' => $setId, 'form_ids' => $formIds]);
            return false;
        }
    }

    public function detachFormFromSet($setId, $formId)
    {
        try {
            SurveySetForm::where('survey_set_id', $setId)->where('form_id', $formId)->delete();
            $items = SurveySetForm::where('survey_set_id', $setId)->orderBy('order')->get();
            $order = 1;
            foreach ($items as $item) {
                $item->order = $order++;
                $item->save();
            }
            return true;
        } catch (Exception $e) {
            Log::error('Failed to detach form: '.$e->getMessage(), ['set_id' => $setId, 'form_id' => $formId]);
            return false;
        }
    }

    public function updateFormOrder($setId, array $orderedIds)
    {
        DB::beginTransaction();
        try {
            $order = 1;
            foreach ($orderedIds as $fid) {
                SurveySetForm::where('survey_set_id', $setId)->where('form_id', $fid)->update(['order' => $order++]);
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to reorder forms: '.$e->getMessage(), ['set_id' => $setId]);
            return false;
        }
    }

    public function getRespondentProgressForSets(array $setIds = [], $respondentId = null)
    {
        $result = [];
        if (empty($setIds)) return $result;

        $query = RespondentProgress::whereIn('survey_set_id', $setIds);
        if ($respondentId) $query->where('respondent_id', $respondentId);

        $rows = $query->get();

        foreach ($rows as $row) {
            $sid = $row->survey_set_id;
            if (!isset($result[$sid])) {
                $result[$sid] = [
                    'completed' => (int) $row->completed_forms,
                    'total' => (int) $row->total_forms,
                ];
            } else {
                $result[$sid]['completed'] += (int) $row->completed_forms;
                $result[$sid]['total'] += (int) $row->total_forms;
            }
        }

        return $result;
    }

    public function getSurveySetProgressForRespondent($surveySetId, $respondentId)
    {
        $set = SurveySet::with('forms')->find($surveySetId);
        if (!$set) return null;

        $totalForms = $set->forms->count();

        $progress = RespondentProgress::where('survey_set_id', $surveySetId)
            ->where('respondent_id', $respondentId)
            ->first();

        $completedForms = $progress ? $progress->completed_forms : 0;

        return [
            'survey_set_id' => $surveySetId,
            'total_forms' => $totalForms,
            'completed_forms' => $completedForms,
            'progress_percentage' => $totalForms > 0 ? round(($completedForms / $totalForms) * 100, 2) : 0,
        ];
    }

}
