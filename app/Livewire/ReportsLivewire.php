<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Services\QuestionService;
use App\Services\ResponseService;
use App\Services\QuestionnaireService;

class ReportsLivewire extends Component
{ 

    //load questionnaires 
    public $forms = []; 

    //questions of given questionnaire 

    public $questions = []; 

    //responses 

    public $responses = []; 

    //form id 
    public $selectedFormId; 

    //question id 

    public $selectedQuestionId; 

    public $selectedQuestion; 

    public function load_forms_or_questionnaires(QuestionnaireService $service)
    { 
          $this->forms =$service->get_all();
    }//endof
    

    //load questions 
    public function load_questions(QuestionService $service)
    {  

       
        
     $this->questions = $service->getAllQuestions($this->selectedFormId);  

   

    }//endof


    //load responses with respondent, answer and option text  
    public function responses(ResponseService $service)
    { 
        $this->responses = $service->responses($this->selectedQuestionId); 

        // Also load the selected question model for use in the view or logic
        if ($this->selectedQuestionId) {
            $this->selectedQuestion = Question::find($this->selectedQuestionId);
        } else {
            $this->selectedQuestion = null;
        }

    } //endof func
 

    public function mount()
    {
        $this->load_forms_or_questionnaires(new QuestionnaireService());
    }


    public function render()
    { 

        if($this->selectedQuestionId)
        {
            $this->responses(new ResponseService());
        }
        return view('livewire.reports-livewire');
    }
}
