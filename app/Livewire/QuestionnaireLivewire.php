<?php

namespace App\Livewire;

use App\Models\Form;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Services\QuestionnaireService;

class QuestionnaireLivewire extends Component
{

    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $description;
    #[Validate('required')]
    public $category;  

    //edit attributes

    public $editingFormId;

    public $editingFormTitle;

    public $editingFormDescription;

    public $editingFormCategory;
   
    public $editingFormStatus = 'Active';

    
 

    //attribute to hold existing forms 

    public $forms = [];

    public function mount(QuestionnaireService $service)
    {
        $this->forms = $service->getAllForms();
    }
    //function to save a new form or questionnaire 

    public function save(QuestionnaireService $service)
    { 
        //validate
        $data = $this->validate(); 

        //send the rest of the logic to service  

       $res =  $service->saveForm($data);

        //display flash messages and notify  
        if($res)
        { 

            $this->forms =  $service->getAllForms();

            $this->feedback('form-saved','New Form Has Been Created Successfully');
        } 
        else{ 

            $this->feedback(null,'New Form Failed To Create');

        }


    } //endof function 

    //this is a function to edit a form

    public function edit(Form $form)
    { 

      //dispatch an event to open edit form modal  
      $this->editingFormId = $form->id;
      $this->editingFormTitle = $form->title;
      $this->editingFormDescription = $form->description;
      $this->editingFormCategory = $form->category;
      $this->editingFormStatus = $form->status ?? 'Active';

      $this->feedback("open-edit",null);
      

    }//endof function 

    //function to update edit form 

    public function updateForm(QuestionnaireService $service)
    {
        // Validate the updated form data
        $rules = [
            'editingFormTitle' => 'required|string|max:255',
            'editingFormDescription' => 'required|string',
            'editingFormCategory' => 'required|string|max:255',
            'editingFormStatus' => 'required|string|in:Published,Draft,Archived',
        ];

        $data = $this->validate($rules);

        $data['id'] = $this->editingFormId;

        $res =  $service->updateForm($data);

    if ($res) { 

        $this->forms= $service->getAllForms();

            $this->feedback('form-updated', 'Form updated successfully');
        } else {
            $this->feedback(null, 'Failed to update form');
        }

      
    }//endof function 

    //function to delete a form 

    public function delete(Form $form,QuestionnaireService $service)
    {  
        //delete
        $form->delete();   

        //relaod forms
        $this->forms = $service->getAllForms();

        //feedback 
        $this->feedback('form-deleted', 'Form deleted successfully'); 



    } 

    //function to redirect to a questions page 

    public function addQuestions(Form $form)
    {
        $id = $form->id; 

        return redirect()->route('questions', ['id' => $id]);
    }

    //this is a function to generate events and also to create flash messages  

    public function feedback($eventName=null,$message=null)
    { 

        if ($eventName) {
            $this->dispatch($eventName); 
        }

        if ($message) {
            session()->flash('message', $message);
        }

    } //endof function 

    //default render function 

    public function render()
    {
        return view('livewire.questionnaire-livewire');
    }
}
