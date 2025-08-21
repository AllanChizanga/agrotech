<?php

namespace App\Livewire;

use Livewire\Component;
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

    public function load_forms_or_questionnaires(QuestionnaireService $service)
    { 
          $this->forms =$service->get_all();
    }//endof
    

    //load questions 
    public function load_questions($id,QuestionService $service)
    { 
        
     $this->questions = $service->getAllQuestions($id);

    }//endof


    //load responses with respondent, answer and option text  
    public function responses($qtn_id,ResponseService $service)
    { 

        $this->responses = $service->responses($qtn_id);

    } 
 

    public function mount()
    {
        $this->load_forms_or_questionnaires(new QuestionnaireService());
    }


    public function render()
    {
        return view('livewire.reports-livewire');
    }
}
