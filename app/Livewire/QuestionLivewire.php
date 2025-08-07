<?php

namespace App\Livewire;

use App\Models\Form;
use Livewire\Component;
use App\Models\Question;
use App\Models\QuestionType;
use App\Services\OptionService;
use App\Services\QuestionService;

class QuestionLivewire extends Component
{   

    public $questions = []; 
    public $questionTypes = []; 
    public $options = []; 
    public $options_edited = [];
    public $optionCounter =  1;


    //attributes
    public $question_text;
    public $question_type = '';
    public $question_order;
    public $is_required = false;
    public $depends_on_question;
    public $depends_on_answer; 

    //editing question atrributes 

    // Attributes for editing question
    public $editingQuestionId = null;
    public $editingQuestionText;
    public $editingQuestionType;
    public $editingQuestionOrder;
    public $editingIsRequired = false;
    public $editingDependsOnQuestion;
    public $editingDependsOnAnswer;
    public $editingOptions = [];

    //Form  Attributes 
    public $form_id;
    public $form_title;
    public $form_description;

 
 

    public function saveQuestion(QuestionService $service,OptionService $optionService)
    {    

        
        // Validate required fields
        $this->validate([
            'question_text' => 'required|string|max:255',
            'question_type' => 'required|string',
            'question_order' => 'required|integer|min:1',
        ]);

        // If the question type requires options, validate options
        $typesWithOptions = ['multiple-choice', 'dropdown', 'checkbox'];
        if (in_array($this->question_type, $typesWithOptions)) {
            $this->validate([
                'options' => 'required|array|min:2',
                'options.*' => 'required|string|max:255',
            ]);
        }

        //create question
        $data = [
            'form_id' => $this->form_id,
            'question_text' => $this->question_text,
            'question_type' => $this->question_type,
            'question_order' => $this->question_order,
            'is_required' => $this->is_required,
            'depends_on_question' => $this->depends_on_question,
            'depends_on_answer' => $this->depends_on_answer,
        ];

        $options = $this->options;

        $question = $service->saveQuestion($data);

        //create options for the question  

        $optionService->saveOptions($question->id,$options); 

        //feedback 

        session()->flash('message', 'Question and options saved successfully!');
        // Optionally, reset form fields after saving
        $this->reset([
            'question_text',
            'question_type',
            'question_order',
            'is_required',
            'depends_on_question',
            'depends_on_answer',
            'options',
        ]); 

        $this->dispatch('question-saved');

    // Reload the questions after saving a new question
    $this->questions = $service->getAllQuestions($this->form_id);


    }
    //function to increase option counter 

    public function increaseOptionCounter()
    {
        $this->optionCounter =  $this->optionCounter + 1;
   
    } 

    public function questionTypeChanged()
    {
    
    } 

    //function to open the modal to display the options 

    public function openOptions($id,OptionService $service)
    {  

        // dd($service->getOptions($id));

        $this->options_edited = $service->getOptions($id); 

        $this->dispatch('open-options-modal');

    } 

    //function to delete a question 

    public function deleteQuestion(Question $qtn,QuestionService $service)
    { 

        $res =  $service->delete($qtn);


        if ($res) {
            // Remove the deleted question from the local questions collection
            $this->questions = $service->getAllQuestions($this->form_id);

            // Optionally, show a success notification
            $this->dispatch('question-deleted');
        } else {
            // Optionally, show an error notification
            $this->dispatch('question-delete-failed');
        }

    } 


    //function to edit the question 

    public function editQuestion(Question $qtn)
    {
    $this->editingQuestionText = $qtn->question_text;
    $this->editingQuestionType = $qtn->question_type;
    $this->editingQuestionOrder = $qtn->question_order;
    $this->editingIsRequired = $qtn->is_required;
    $this->editingDependsOnQuestion = $qtn->depends_on_question;
    $this->editingDependsOnAnswer = $qtn->depends_on_answer; 

    $this->dispatch('open-edit-qtn-modal');

    } 

    //function to update question 

    public function updateQuestion(QuestionService $service)
    {  
        // Validate the input fields for updating a question
        $data = $this->validate([
            'editingQuestionText' => 'required|string|max:255',
            'editingQuestionOrder' => 'nullable|integer|min:1',
         ]);

        

        $res = $service->update($data); 

        if($res)
        {
            $this->dispatch('close-edit-modal');
        }

    }

    public function mount($id, QuestionService $service)
    {    
        
    

    // fetch question types
    $form = Form::findOrFail($id);
    //fill the form attributes 
    $this->form_id = $form->id;
    $this->form_title = $form->title;
    $this->form_description = $form->description; 

    //fetch all question types

    $this->questionTypes = QuestionType::all(); 

    //fetch all questions 

    $this->questions = $service->getAllQuestions($this->form_id);

    }
    public function render()
    {   

     
        return view('livewire.question-livewire');
    }
}
