<?php

namespace App\Exports;

use App\Models\Question;
use App\Exports\DataExport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataExport implements FromView
{ 
     public $form_id;

    public function __construct($id)
    { 
        $this->form_id = $id;

    }//endof function 

    public function view(): View
    {  

        // Fetch all questions for the given form, with their answers, respondent, and option
        $reports = Question::where('form_id', $this->form_id)
            ->with(['answers.response.respondent', 'answers.option'])
            ->get();

        return view('exports.reports', [
            'reports' => $reports
        ]);
    }
}
