<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResponsesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //response model 

            'form_id'=>'required',//questionnaire  ---must be provided 
            'respondent' => 'required|array',   //provide this ---this is a linear array 
            'respondent.fullname' => 'required|string',
            'respondent.national_id' => 'required|string',
            'respondent.phone' => 'required|string',
            'respondent.address' => 'required|string',
            'respondent.country' => 'required|string',
            'respondent.city' => 'required|string',
            'respondent.email' => 'required|email',
            'answers' => 'required|array', //provide this ---answers is an array of arrays 
            'answers.*.question_id' => 'required',
            'answers.*.answer_text' => 'nullable',
            'answers.*.option_id' => 'nullable',
        ];
    }


    //payload example 
/**
 * {
  "form_id": 123,
  "respondent": {
    "fullname": "John Doe",
    "national_id": "123456789",
    "phone": "+1234567890",
    "address": "123 Main St",
    "country": "Kenya",
    "city": "Nairobi",
    "email": "john@example.com"
  },
  "answers": [
    {
      "question_id": 1,
      "answer_text": "Yes",
      "option_id": null
    },
    {
      "question_id": 2,
      "option_id": 5,
      "answer_text": null
    }
  ]
}

 */
    
}
