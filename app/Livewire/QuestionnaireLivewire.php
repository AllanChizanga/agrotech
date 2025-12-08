<?php

namespace App\Livewire;

use App\Models\Form;
use App\Models\SurveySet;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Services\QuestionnaireService;

class QuestionnaireLivewire extends Component
{
    // -----------------------
    // Form creation attributes
    // -----------------------
    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $description;
    #[Validate('required')]
    public $category;

    // -----------------------
    // Form editing attributes
    // -----------------------
    public $editingFormId;
    public $editingFormTitle;
    public $editingFormDescription;
    public $editingFormCategory;
    public $editingFormStatus = 'Active';

    // -----------------------
    // Survey Sets attributes
    // -----------------------
    public $setTitle;
    public $setDescription;
    public $editingSetId;
    public $editingSetTitle;
    public $editingSetDescription;

    // -----------------------
    // Lists + selection
    // -----------------------
    public $forms = [];
    public $surveySets = [];
    public $selectedSetId = null;
    public $setForms = [];

    // -----------------------
    // UI helpers
    // -----------------------
    public $searchSet;
    public $searchForm;
    public $perPage = 12;
    public $page = 1;

    // Progress map: set_id => ['completed'=>x,'total'=>y]
    public $progress = [];

    protected $listeners = [
        'reorderForms' => 'handleReorderFromJs',
    ];

    public function mount(QuestionnaireService $service)
    {
        $this->forms = $service->getAllForms();
        $this->surveySets = $service->getAllSurveySets();
        $this->selectedSetId = $this->surveySets->first()->id ?? null;

        $this->loadSelectedSetForms();
        $this->loadProgress();
    }

    public function loadSelectedSetForms()
    {
        if (!$this->selectedSetId) {
            $this->setForms = collect();
            return;
        }
        $service = new QuestionnaireService();
        $this->setForms = $service->getFormsForSet($this->selectedSetId);
    }

    public function loadProgress()
    {
        $service = new QuestionnaireService();
        $setIds = $this->surveySets->pluck('id')->toArray();
        $respondentId = null;
        $this->progress = $service->getRespondentProgressForSets($setIds, $respondentId);
    }
    public function openCreateFormModal()
    {
        $this->dispatch('open-create-form-modal');
    }
    public function addQuestions(Form $form)
    {
        $id = $form->id; 

        return redirect()->route('questions', ['id' => $id]);
    }

    // -----------------------
    // Survey Sets CRUD
    // -----------------------
    public function openCreateSetModal()
    {
        $this->reset(['setTitle', 'setDescription']);
        $this->dispatch('open-create-set-modal');
    }

    public function saveSet(QuestionnaireService $service)
    {
        $data = $this->validate([
            'setTitle' => 'required|string|max:255',
            'setDescription' => 'nullable|string',
        ]);

        $res = $service->saveSet([
            'title' => $this->setTitle,
            'description' => $this->setDescription,
        ]);

        if ($res) {
            $this->surveySets = $service->getAllSurveySets($this->searchSet);
            $this->feedback('set-saved', 'Set created');
            $this->loadProgress();
            $this->selectedSetId = $this->surveySets->first()->id ?? $this->selectedSetId;
            $this->loadSelectedSetForms();
        } else {
            $this->feedback(null, 'Failed to create set');
        }
    }

    public function editSet(SurveySet $set)
    {
        $this->editingSetId = $set->id;
        $this->editingSetTitle = $set->title;
        $this->editingSetDescription = $set->description;
        $this->dispatch('open-edit-set-modal');
    }

    public function updateSet(QuestionnaireService $service)
    {
        $data = $this->validate([
            'editingSetTitle' => 'required|string|max:255',
            'editingSetDescription' => 'nullable|string',
        ]);

        $res = $service->updateSet([
            'id' => $this->editingSetId,
            'title' => $this->editingSetTitle,
            'description' => $this->editingSetDescription,
        ]);

        if ($res) {
            $this->surveySets = $service->getAllSurveySets($this->searchSet);
            $this->feedback('set-updated', 'Set updated');
            $this->loadProgress();
            $this->loadSelectedSetForms();
        } else {
            $this->feedback(null, 'Failed to update set');
        }
    }

    public function deleteSet(SurveySet $set, QuestionnaireService $service)
    {
        $service->deleteSet($set);
        $this->surveySets = $service->getAllSurveySets($this->searchSet);
        $this->feedback('set-deleted', 'Set deleted');
        $this->selectedSetId = $this->surveySets->first()->id ?? null;
        $this->loadSelectedSetForms();
    }

    // -----------------------
    // Attach / Detach / Reorder
    // -----------------------
    public function openAttachFormModal()
    {
        $this->forms = (new QuestionnaireService())->getAllForms();
        $this->dispatch('open-attach-modal');
    }

    public function attachForms($formIds = [])
    {
        if (!$this->selectedSetId) return $this->feedback(null, 'No set selected');
        if (empty($formIds)) return $this->feedback(null, 'No forms selected');

        $service = new QuestionnaireService();
        $service->attachFormsToSet($this->selectedSetId, $formIds);

        $this->loadSelectedSetForms();
        $this->feedback('forms-attached', 'Forms attached to set');
    }

    public function detachForm($formId)
    {
        if (!$this->selectedSetId) return $this->feedback(null, 'No set selected');
        $service = new QuestionnaireService();
        $service->detachFormFromSet($this->selectedSetId, $formId);
        $this->loadSelectedSetForms();
        $this->feedback('form-detached', 'Form detached');
    }

    public function handleReorderFromJs($orderedIds, $setId)
    {
        if (!$setId || !is_array($orderedIds)) return;
        $service = new QuestionnaireService();
        $service->updateFormOrder($setId, $orderedIds);
        $this->loadSelectedSetForms();
        $this->feedback(null, 'Order updated');
    }

    // -----------------------
    // Forms CRUD
    // -----------------------
    public function save(QuestionnaireService $service)
    {
        $data = $this->validate();
        $res = $service->saveForm($data);

        if ($res) {
            $this->forms = $service->getAllForms();
            $this->dispatch('form-saved');
            $this->feedback('form-saved', 'New Form Has Been Created Successfully');
        } else {
            $this->feedback(null, 'New Form Failed To Create');
        }
    }

    public function edit(Form $form)
    {
        $this->editingFormId = $form->id;
        $this->editingFormTitle = $form->title;
        $this->editingFormDescription = $form->description;
        $this->editingFormCategory = $form->category;
        $this->editingFormStatus = $form->status ?? 'Active';
        $this->dispatch('open-edit-form-modal');
    }

    
    public function updateForm(QuestionnaireService $service)
    {
        // dd($this);
        $data = $this->validate([
            'editingFormTitle' => 'required|string|max:255',
            'editingFormDescription' => 'required|string',
            'editingFormCategory' => 'required|string|max:255',
            'editingFormStatus' => 'required|string|in:published,draft,archived,active',
        ]);
        // dd($data);
       

        $data['id'] = $this->editingFormId;
         
        $res = $service->updateForm($data);
        // dd($res);
        if ($res) {
            $this->forms = $service->getAllForms();
            $this->dispatch('form-updated'); // <-- new
            $this->feedback('form-updated', 'Form updated successfully');
        }else {
            $this->feedback(null, 'Failed to update form');
        }
    }

    public function delete(Form $form, QuestionnaireService $service)
    {
        $form->delete();
        $this->forms = $service->getAllForms();
        $this->feedback('form-deleted', 'Form deleted successfully');
    }

    // -----------------------
    // UI Selection
    // -----------------------
    public function selectSet($setId)
    {
        $this->selectedSetId = $setId;
        $this->loadSelectedSetForms();
    }

    // -----------------------
    // Helpers
    // -----------------------
    public function feedback($eventName = null, $message = null)
    {
        if ($eventName) $this->dispatch($eventName);
        if ($message) session()->flash('message', $message);
    }

    public function render()
    {
        $service = new QuestionnaireService();
        $this->surveySets = $service->getAllSurveySets($this->searchSet);
        $this->forms = $service->getAllForms();
        $this->loadProgress();
        $this->loadSelectedSetForms();

        return view('livewire.questionnaire-livewire');
    }
}
