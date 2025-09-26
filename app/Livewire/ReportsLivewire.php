<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Exports\DataExport;
use App\Services\QuestionService;
use App\Services\ResponseService;
use Maatwebsite\Excel\Facades\Excel;
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


    public function export()
    { 
         //selectedQuestionId  
         return Excel::download(new DataExport($this->selectedFormId), 'data-report.xlsx');

    }

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

        
        $this->dispatch('update-chart', chartData: $this->chartData);
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

   
  
    

    public function getChartDataProperty()
    {
        $question = $this->selectedQuestion;
        $responses = collect($this->responses);

        if (!$question) return [
            'labels' => [],
            'data' => [],
            'type' => 'bar',
        ];

        $type = $question->question_type;
        $labels = [];
        $data = [];

        $optionTypes = [
            'multiple-choice', 'checkbox', 'dropdown', 'linear-scale'
        ];
        $submittedTypes = [
            'paragraph', 'short-answer', 'date', 'time', 'numerical-integer', 'decimal'
        ];
        $fileTypes = [
            'file-upload', 'image', 'video', 'document'
        ];

        if (in_array($type, $optionTypes)) {
            $options = $question->options ?? [];
            foreach ($options as $option) {
                $labels[] = $option->option_text;
                $count = $responses->where('option_id', $option->id)->count();
                $data[] = $count;
            }
        } elseif (in_array($type, $submittedTypes)) {
            $labels = ['Submitted', 'Not Submitted'];
            $submitted = $responses->where('answer_text', '!=', null)->count();
            $notSubmitted = $responses->where('answer_text', null)->count();
            $data = [$submitted, $notSubmitted];
        } elseif (in_array($type, $fileTypes)) {
            $labels = ['File Submitted', 'No File'];
            $submitted = $responses->where('answer_text', '!=', null)->count();
            $notSubmitted = $responses->where('answer_text', null)->count();
            $data = [$submitted, $notSubmitted];
        } else {
            $labels = ['Answered', 'No Answer'];
            $answered = $responses->where('answer_text', '!=', null)->count();
            $noAnswer = $responses->where('answer_text', null)->count();
            $data = [$answered, $noAnswer];
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'type' => 'bar',
        ];
    }


}
